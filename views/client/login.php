<style>
body {
  background: #f5f7fa;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
#login {
  max-width: 350px;
  margin: 100px auto 100 auto;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 12px rgba(21, 101, 192, 0.09);
  padding: 32px 28px 28px 28px;
  text-align: center;
}
#login h1 {
  color: #1565c0;
  font-size: 1.6rem;
  margin-bottom: 28px;
  font-weight: 600;
}
#login form {
  display: flex;
  flex-direction: column;
  gap: 18px;
}
#login input[type="text"],
#login input[type="password"] {
  padding: 10px 12px;
  border: 1px solid #cfd8dc;
  border-radius: 6px;
  font-size: 15px;
  background: #f8fafc;
  transition: border 0.2s;
}
#login input:focus {
  border-color: #1565c0;
  outline: none;
}
#login button {
  background: #1565c0;
  color: #fff;
  border: none;
  border-radius: 6px;
  padding: 12px 0;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  margin-top: 10px;
  transition: background 0.2s;
}
#login button:hover {
  background: #0d47a1;
}
@media (max-width: 500px) {
  #login {
    padding: 18px 6px 18px 6px;
  }
}
</style>
<?php  
?>
<main>
    <div class="container">
       <div id="login">
        <h1>Đăng nhập tài khoản</h1>
        <form action="/duan_mau/duan_mau1/?act=login" method="POST">
            <input type="text" name="username" placeholder="Tên đăng nhập" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <a href="/duan_mau/duan_mau1/?act=register">Đăng kí tài khoản</a>
            <button type="submit">Đăng nhập</button>
        </form>
       </div>
    </div>
</main>
<?php  
?>