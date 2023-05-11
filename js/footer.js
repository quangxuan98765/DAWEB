const createFooter = () => {
    let footer = document.querySelector('footer');

    footer.innerHTML =`
    <div class="footer-content">
    <img src="img/light-logo.png" class="logo" alt="">
    <div class="footer-ul-container">
        <ul class="category">
            <li class="category-title">Laptop</li>
            <li><a href="menarmor.html" class="footer-link">armor</a></li>
            <li><a href="accessories.html" class="footer-link">phụ kiện</a></li>
            <li><a href="#" class="footer-link">mũ</a></li>
            <li><a href="#" class="footer-link">giày</a></li>
            <li><a href="#" class="footer-link">găng tay</a></li>
            <li><a href="#" class="footer-link">súng</a></li>
        </ul>
        <ul class="category">
            <li class="category-title">Phụ Kiện</li>
            <li><a href="womenarmor.html" class="footer-link">armor</a></li>
            <li><a href="accessories.html" class="footer-link">phụ kiện</a></li>
            <li><a href="#" class="footer-link">mũ</a></li>
            <li><a href="#" class="footer-link">giày</a></li>
            <li><a href="#" class="footer-link">găng tay</a></li>
            <li><a href="#" class="footer-link">súng</a></li>
        </ul>
    </div>
</div>
<p class="footer-title">Thông tin của chúng tôi</p>
<p class="info" style="color:white;">Đồ án website bán hàng môn "Lập trình web và ứng dụng" - lớp CLC C4, trường Đại học Sài Gòn. Chúng tôi gồm 1 thành viên, là: Quang sasuke. Website này cấu tạo thuần bằng css và js cơ bản, có tham khảo từ nhiều nguồn. Xin cảm ơn.</p>
<p class="info">email liên hệ: - emtalam@gmail.com</p>
<p class="info">số điện thoại: - 0386393932</p>
<div class="footer-social-container">
    <div>
        <a href="#" class="social-link">Điều khoản dịch vụ và chính sách bảo mật</a>
        <a href="#" class="social-link">Trang cá nhân</a>
        <a href="#" class="social-link">instagram</a>
        <a href="https://www.facebook.com/profile.php?id=100008726139053" class="social-link">facebook</a>
        <a href="#" class="social-link">twitter</a>
    </div>
</div>
<p class="footer-credit">Gánh cồng lưng</p>    
    `;
}

createFooter();