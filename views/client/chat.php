
<style>
  .chat-container{max-width:800px;margin:28px auto;background:#fff;padding:18px;border-radius:10px;box-shadow:0 2px 12px rgba(0,0,0,0.06)}
  .chat-history{height:320px;overflow:auto;border:1px solid #eee;padding:12px;border-radius:6px;background:#fafafa}
  .chat-msg{margin-bottom:10px}
  .chat-msg.user{text-align:right}
  .chat-bubble{display:inline-block;padding:8px 12px;border-radius:12px;max-width:75%}
  .chat-bubble.user{background:#1565c0;color:#fff}
  .chat-bubble.bot{background:#f1f5f9;color:#111}
  .chat-input{display:flex;gap:8px;margin-top:12px}
  .chat-input textarea{flex:1;padding:8px;border-radius:6px;border:1px solid #ccc}
  .chat-input button{background:#1565c0;color:#fff;border:none;padding:8px 16px;border-radius:6px}
</style>
<main>
  <div class="container">
    <div class="chat-container">
      <div id="chatHistory" class="chat-history"></div>

      <form id="chatForm" class="chat-input">
        <textarea name="message" rows="2" placeholder="Gõ câu hỏi (ví dụ: giá iPhone 13)"></textarea>
        <button type="submit">Gửi</button>
      </form>
    </div>
  </div>
</main>

<script>
const historyEl = document.getElementById('chatHistory');
const form = document.getElementById('chatForm');
const BASE_URL = "<?= BASE_URL ?>";

function renderProductCards(products){
  if(!products || !products.length) return;
  const wrapper = document.createElement('div');
  wrapper.style.display = 'grid';
  wrapper.style.gridTemplateColumns = 'repeat(auto-fill, minmax(220px, 1fr))';
  wrapper.style.gap = '10px';
  wrapper.style.marginTop = '10px';

  products.forEach(p => {
    const card = document.createElement('div');
    card.style.border = '1px solid #e6e6e6';
    card.style.borderRadius = '8px';
    card.style.padding = '8px';
    card.style.background = '#fff';

    const img = document.createElement('img');
    img.style.width = '100%';
    img.style.height = '120px';
    img.style.objectFit = 'cover';
    img.style.borderRadius = '6px';
    if(p.image){
      let src = p.image;
      if(!/^https?:\/\//i.test(src) && src.charAt(0) !== '/'){
        src = BASE_URL + (src.startsWith('./') ? src.slice(2) : src);
      }
      img.src = src;
    } else {
      img.src = BASE_URL + 'uploads/imgproduct/OIP.jfif';
    }

    const name = document.createElement('div');
    name.style.fontWeight = '600';
    name.style.marginTop = '8px';
    name.textContent = p.name;

    const price = document.createElement('div');
    price.style.color = '#1565c0';
    price.style.marginTop = '6px';
    price.textContent = p.price_text || (p.price ? new Intl.NumberFormat().format(p.price) + ' VNĐ' : 'Liên hệ');

    const link = document.createElement('a');
    link.href = p.link || '#';
    link.textContent = 'Xem chi tiết';
    link.style.display = 'inline-block';
    link.style.marginTop = '8px';
    link.style.color = '#fff';
    link.style.background = '#1565c0';
    link.style.padding = '6px 8px';
    link.style.borderRadius = '6px';
    link.style.textDecoration = 'none';

    card.appendChild(img);
    card.appendChild(name);
    card.appendChild(price);
    card.appendChild(link);

    wrapper.appendChild(card);
  });

  const containerDiv = document.createElement('div');
  containerDiv.style.marginTop = '8px';
  containerDiv.appendChild(wrapper);
  historyEl.appendChild(containerDiv);
  historyEl.scrollTop = historyEl.scrollHeight;
}

function appendMessage(text, who='bot'){
  const div = document.createElement('div');
  div.className = 'chat-msg ' + (who==='user' ? 'user' : 'bot');
  const bubble = document.createElement('div');
  bubble.className = 'chat-bubble ' + (who==='user' ? 'user' : 'bot');
  // text is plain text; escape it by creating a text node
  bubble.appendChild(document.createTextNode(text));
  div.appendChild(bubble);
  historyEl.appendChild(div);
  historyEl.scrollTop = historyEl.scrollHeight;
}

function appendMessageHtml(html, who='bot'){
  const div = document.createElement('div');
  div.className = 'chat-msg ' + (who==='user' ? 'user' : 'bot');
  const bubble = document.createElement('div');
  bubble.className = 'chat-bubble ' + (who==='user' ? 'user' : 'bot');
  bubble.innerHTML = html; // already sanitized server-side
  div.appendChild(bubble);
  historyEl.appendChild(div);
  historyEl.scrollTop = historyEl.scrollHeight;
}

form.addEventListener('submit', async function(e){
  e.preventDefault();
  const msg = this.message.value.trim();
  if(!msg) return;
  appendMessage(msg,'user');
  this.message.value = '';

  try{
    const fd = new FormData();
    fd.append('message', msg);
    const res = await fetch('?act=chat-send', {method:'POST', body:fd});
    const data = await res.json();
    if(data.status){
      if(data.data.reply_html){
        appendMessageHtml(data.data.reply_html,'bot');
      } else {
        appendMessage(data.data.reply,'bot');
      }
      // If products were returned, render product cards
      if(data.data.products){
        renderProductCards(data.data.products);
      }
    } else {
      appendMessage('Lỗi: ' + data.message,'bot');
    }
  }catch(err){
    console.error(err);
    appendMessage('Có lỗi kết nối. Vui lòng thử lại sau.','bot');
  }
});

// Greeting
appendMessage('Chào bạn! tôi có thể giúp gì cho bạn?');
</script>
