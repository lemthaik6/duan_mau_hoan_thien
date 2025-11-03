<?php
// Simple keyword-based chatbot model. Can be replaced later by an AI API integration.
class ChatModel {
    public $conn;
    public $productModel;

    public function __construct() {
        // optional DB connection and product model for product lookup
        $this->conn = function_exists('connectDB') ? connectDB() : null;
        if (class_exists('ProductModel')) {
            $this->productModel = new ProductModel();
        } else {
            $this->productModel = null;
        }
    }

    // Returns a simple response string based on the user message
    public function getResponse(string $message): string {
        $msg = mb_strtolower(trim($message));

        // common keywords for phone sales
        $keywords = [
            'giá' => 'Bạn quan tâm giá của mẫu nào? Cho tôi biết tên hoặc mã sản phẩm để tôi báo giá chính xác.',
            'giá bao nhiêu' => 'Bạn có thể cho biết model cụ thể không? Ví dụ: iPhone 13, Samsung A54...',
            'pin' => 'Dung lượng pin khác nhau theo model. Bạn cần pin trâu hay sạc nhanh hơn?',
            'camera' => 'Bạn ưu tiên camera chụp ban ngày hay ban đêm/zoom?',
            'khuyến mãi' => 'Hiện shop có nhiều chương trình giảm giá tuỳ model. Bạn muốn xem sản phẩm đang khuyến mãi không?',
            'màu' => 'Màu sắc thường có sẵn: Đen, Trắng, Xanh, Tím... Bạn thích màu nào?',
            'trả góp' => 'Chúng tôi hỗ trợ trả góp 0% qua các công ty tài chính — bạn muốn xem các phương án trả góp không?',
            'bảo hành' => 'Sản phẩm chính hãng thường có bảo hành 12 tháng. Bạn muốn biết chi tiết bảo hành cho model nào?'
        ];

        foreach ($keywords as $k => $reply) {
            if (mb_stripos($msg, $k) !== false) {
                return $reply;
            }
        }

        // Simple intents
        if (mb_stripos($msg, 'xin chào') !== false || mb_stripos($msg, 'hi') !== false || mb_stripos($msg, 'hello') !== false) {
            return 'Chào bạn! Mình có thể giúp tư vấn mua điện thoại, báo giá, so sánh model, hoặc hỗ trợ trả góp. Bạn cần gì?';
        }

        if (mb_stripos($msg, 'mua') !== false || mb_stripos($msg, 'mua hàng') !== false || mb_stripos($msg, 'đặt hàng') !== false) {
            return 'Bạn muốn đặt mua chiếc điện thoại nào? Gửi tên model hoặc ID sản phẩm nhé.';
        }

        // default fallback
        return 'Mình chưa hiểu. Bạn có thể mô tả rõ hơn (model, ngân sách, tính năng cần thiết) hoặc gõ "khuyến mãi"/"giá"/"camera" để mình hỗ trợ.';
    }

    // Placeholder for integrating an external AI API in future
    public function getResponseFromApi(string $message)
    {
        // First try product lookup (if product model available)
        $productReply = $this->tryProductLookup($message);
        if ($productReply !== null) {
            // If OpenAI is configured, ask it to craft a friendly summary using the found products
            if (defined('OPENAI_API_KEY') && OPENAI_API_KEY) {
                $apiKey = OPENAI_API_KEY;

                // Build a short product context
                $prodLines = [];
                foreach ($productReply['products'] as $pr) {
                    $prodLines[] = ($pr['name'] ?? '') . ' - ' . ($pr['price_text'] ?? '') . ' - ' . ($pr['link'] ?? '');
                }
                $prodContext = implode("\n", $prodLines);

                $system = 'Bạn là trợ lý bán hàng cho một cửa hàng điện thoại tại Việt Nam. Hãy trả lời ngắn gọn, lịch sự, và khi phù hợp hãy nhắc tới các sản phẩm được liệt kê sau đây. Không thêm nội dung độc hại.';
                $userPrompt = "Người dùng hỏi: \"{$message}\"\nDanh sách sản phẩm liên quan:\n" . $prodContext . "\nHãy trả lời bằng văn phong thân thiện, tóm tắt 1-2 câu và kèm hướng dẫn 'Xem chi tiết' nếu cần.'";

                $payload = [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => $system],
                        ['role' => 'user', 'content' => $userPrompt]
                    ],
                    'temperature' => 0.2,
                    'max_tokens' => 300
                ];

                $ch = curl_init('https://api.openai.com/v1/chat/completions');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $apiKey
                ]);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
                $resp = curl_exec($ch);
                $err = curl_error($ch);
                curl_close($ch);

                if ($resp !== false && !$err) {
                    $data = json_decode($resp, true);
                    if (isset($data['choices'][0]['message']['content'])) {
                        $aiText = trim($data['choices'][0]['message']['content']);
                        return ['text' => $aiText, 'products' => $productReply['products']];
                    }
                }
                // if OpenAI call fails, fall back to structured product reply
                return $productReply;
            }
            return $productReply;
        }

        // If OPENAI_API_KEY is set, call OpenAI Chat Completions for a richer reply
        if (defined('OPENAI_API_KEY') && OPENAI_API_KEY) {
            $apiKey = OPENAI_API_KEY;
            $payload = [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'Bạn là trợ lý bán hàng cho một cửa hàng điện thoại tại Việt Nam. Trả lời ngắn gọn, lịch sự, và khi có thể đề xuất sản phẩm với link đầy đủ. Nếu có giá, sử dụng định dạng VNĐ.'],
                    ['role' => 'user', 'content' => $message]
                ],
                'temperature' => 0.2,
                'max_tokens' => 400
            ];

            $ch = curl_init('https://api.openai.com/v1/chat/completions');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $apiKey
            ]);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
            $resp = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);

            if ($resp === false || $err) {
                // on error, fall back to local logic
                return $this->getResponse($message);
            }

            $data = json_decode($resp, true);
            if (isset($data['choices'][0]['message']['content'])) {
                return trim($data['choices'][0]['message']['content']);
            }
            // fallback
            return $this->getResponse($message);
        }

        // Fallback to local keyword-based response
        return $this->getResponse($message);
    }

    // Try finding products matching the user's message. Returns structured array or null.
    private function tryProductLookup(string $message): ?array
    {
        if (!$this->productModel) return null;

        // Use product search; the existing ProductModel has searchProduct()
        $results = $this->productModel->searchProduct($message);
        if (empty($results)) return null;

        $products = [];
        $count = 0;
        foreach ($results as $p) {
            $count++;
            $products[] = [
                'id' => $p['id'] ?? 0,
                'name' => $p['name'] ?? 'Sản phẩm',
                'price' => isset($p['price']) ? (int)$p['price'] : null,
                'price_text' => isset($p['price']) ? number_format($p['price']) . ' VNĐ' : 'Liên hệ',
                'link' => BASE_URL . '?act=detail&id=' . ($p['id'] ?? 0),
                'image' => $p['image'] ?? null,
            ];
            if ($count >= 5) break;
        }

        $textLines = [];
        foreach ($products as $pr) {
            $textLines[] = $pr['name'] . ' - ' . $pr['price_text'] . ' - Xem: ' . $pr['link'];
        }

        $text = "Mình tìm thấy các sản phẩm liên quan:\n" . implode("\n", $textLines);

        return ['text' => $text, 'products' => $products];
    }
}

?>
