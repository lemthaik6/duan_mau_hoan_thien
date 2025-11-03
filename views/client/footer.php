
<footer>
   <div class="container flex">
      <div class="col">
         <h4>Về chúng tôi</h4>
         <p>Website bán hàng chuyên nghiệp, uy tín, phục vụ khách hàng 24/7.</p>
      </div>
      <div class="col">
         <h4>Liên hệ</h4>
         <ul>
            <li>Hotline: 0354966919</li>
            <li>Email: lemthai1808@gmail.com</li>
            <li>Địa chỉ: Hà Nội</li>
         </ul>
      </div>
      <div class="col">
         <h4>Hỗ trợ</h4>
         <ul>
            <li><a href="#">Chính sách bảo hành</a></li>
            <li><a href="#">Chính sách đổi trả</a></li>
            <li><a href="#">Hướng dẫn mua hàng</a></li>
         </ul>
      </div>
      <div class="col">
         <h4>Kết nối</h4>
         <div style="display: flex; gap: 10px;">
            <a href="https://www.facebook.com/lemthai1808"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/facebook.svg" width="24" alt="Facebook"></a>
            <a href="https://www.instagram.com/lemthai1808"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/instagram.svg" width="24" alt="Instagram"></a>
            <a href="https://www.youtube.com/lemthai1808"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/youtube.svg" width="24" alt="YouTube"></a>
         </div>
      </div>
   </div>
   <div style="text-align:center; color:#b0bec5; margin-top:24px; font-size:14px;">
      &copy; <?=date('Y')?> Shop . Leminhthai
   </div>
</footer>
</body>
</html>
<style>
    footer {
    background-color: #1e293b; /* Màu tối */
    color: #e2e8f0; /* Màu chữ sáng */
    padding: 40px 0 20px 0;
    font-family: Arial, sans-serif;
}

footer .container {
    width: 90%;
    margin: auto;
    display: flex;
    flex-wrap: wrap; /* Để responsive */
    justify-content: space-between;
    gap: 20px;
}

footer .col {
    flex: 1 1 200px; /* Độ rộng tối thiểu cho mỗi cột */
}

footer .col h4 {
    font-size: 18px;
    margin-bottom: 15px;
    color: #38bdf8; /* Xanh nổi bật */
}

footer .col p {
    font-size: 14px;
    line-height: 1.6;
}

footer .col ul {
    list-style: none;
    padding: 0;
}

footer .col ul li {
    font-size: 14px;
    margin-bottom: 10px;
}

footer .col ul li a {
    color: #e2e8f0;
    text-decoration: none;
    transition: color 0.3s ease;
}

footer .col ul li a:hover {
    color: #38bdf8;
}

/* Mạng xã hội */
footer .col img {
    filter: invert(1); /* Đổi icon thành màu trắng */
    transition: filter 0.3s ease, transform 0.3s ease;
}

footer .col a:hover img {
    filter: invert(62%) sepia(76%) saturate(355%) hue-rotate(176deg) brightness(95%) contrast(90%);
    transform: scale(1.1);
}

/* Dòng bản quyền */
footer div:last-child {
    border-top: 1px solid #334155;
    padding-top: 15px;
}

/* Responsive */
@media (max-width: 768px) {
    footer .container {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
}

</style>
