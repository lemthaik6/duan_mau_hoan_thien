<?php
class ChatController {
    private $chatModel;

    public function __construct() {
        $this->chatModel = new ChatModel();
    }

    // Render chat page
    public function ChatPage() {
        require_once './views/client/chat.php';
    }

    // Handle AJAX chat send
    public function send() {
        header('Content-Type: application/json; charset=utf-8');

        // Ensure we always return valid JSON even if an exception/warning occurs
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['status' => false, 'message' => 'Phương thức không hợp lệ'], JSON_UNESCAPED_UNICODE);
            exit;
        }

        $message = trim($_POST['message'] ?? '');
        if ($message === '') {
            echo json_encode(['status' => false, 'message' => 'Vui lòng nhập câu hỏi'], JSON_UNESCAPED_UNICODE);
            exit;
        }

        // Capture any stray output and suppress it in the JSON response
        ob_start();
        try {
            // generate reply (may call external APIs)
            $reply = $this->chatModel->getResponseFromApi($message);

            // If the reply is structured (array) it may contain products and text
            $products = null;
            $replyText = '';
            if (is_array($reply)) {
                $replyText = $reply['text'] ?? '';
                $products = $reply['products'] ?? null;
            } else {
                $replyText = (string)$reply;
            }

            // Prepare an HTML-safe version: escape, convert URLs to anchors, convert newlines to <br>
            $replyEscaped = htmlspecialchars($replyText, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
            // linkify URLs
            $replyWithLinks = preg_replace('#(https?://[\w\-\.\?\&\=\/%#]+)#i', '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>', $replyEscaped);
            $replyHtml = nl2br($replyWithLinks);

            // clear any buffer
            ob_end_clean();

            $responseData = [
                'request' => $message,
                'reply' => $replyText,
                'reply_html' => $replyHtml
            ];
            if (!empty($products)) {
                $responseData['products'] = $products;
            }

            echo json_encode([
                'status' => true,
                'message' => 'OK',
                'data' => $responseData
            ], JSON_UNESCAPED_UNICODE);
            exit;
        } catch (\Throwable $e) {
            // discard any buffered output and return structured JSON error
            ob_end_clean();
            $errMsg = 'Lỗi máy chủ: ' . $e->getMessage();
            // Log error to error_log for debugging
            error_log('ChatController::send error: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            echo json_encode(['status' => false, 'message' => 'Có lỗi máy chủ, vui lòng thử lại sau'], JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}

?>
