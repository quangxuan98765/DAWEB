import pytest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.alert import Alert
import time

@pytest.fixture
def driver():
    driver = webdriver.Edge()
    driver.maximize_window()
    yield driver
    driver.quit()

def login(driver, username, password):
    driver.get("http://localhost/ProjectWeb/login.html")
    driver.find_element(By.ID, "username").send_keys(username)
    driver.find_element(By.ID, "password").send_keys(password)
    driver.find_element(By.XPATH, "//*[@id='login-form']/button").click()

def test_user_role_selection(driver):
    # Đăng nhập
    login(driver, "quang", "12345678")
    time.sleep(2)

    # Điều hướng đến trang cần kiểm tra
    driver.find_element(By.XPATH, "/html/body/ul[1]/li[5]/a").click()
    driver.find_element(By.XPATH, "/html/body/div[2]/p[2]").click()
    time.sleep(2)

    select_element = Select(driver.find_element(By.CLASS_NAME, "select-role"))
    
    # Lấy danh sách quyền cần kiểm tra
    roles_to_test = ["user", "normal", "admin"]
    
    for role in roles_to_test:
        # Chọn quyền từ dropdown
        select_element.select_by_visible_text(role)
        
        # Lấy tất cả các hàng trong bảng
        rows = driver.find_elements(By.CLASS_NAME, "data-row")
        
        # Kiểm tra các hàng trong bảng
        for row in rows:
            # Lấy quyền từ thuộc tính `data-role`
            displayed_role = row.get_attribute("data-role")
            
            # Với quyền "user", tất cả các hàng phải hiển thị
            if role == "user":
                assert displayed_role in ["user", "normal", "admin"], (
                    f"Unexpected role '{displayed_role}' when filtering by 'user'."
                )
            else:
                # Với các quyền khác, chỉ các hàng phù hợp mới được hiển thị
                assert displayed_role == role, (
                    f"Displayed role '{displayed_role}' does not match filter '{role}'."
                )

def test_user_edit_functionality(driver):
    
    login(driver, "quang", "12345678")
    time.sleep(2)

    # Điều hướng đến trang cần kiểm tra
    driver.find_element(By.XPATH, "/html/body/ul[1]/li[5]/a").click()
    driver.find_element(By.XPATH, "/html/body/div[2]/p[2]").click()
    time.sleep(2)

    # Tìm hàng đầu tiên để chỉnh sửa
    row = driver.find_element(By.CSS_SELECTOR, 'tr.data-row[data-uname="anhtai123"]')
    username = row.find_elements(By.CSS_SELECTOR, 'a[style="text-transform: none;"]')[1].text  # Lấy tên người dùng ban đầu
    
    # Nhấp vào nút chỉnh sửa
    edit_button = row.find_element(By.CLASS_NAME, "edit-btn")
    edit_button.click()
    time.sleep(2)  # Chờ modal hoặc form chỉnh sửa xuất hiện (nếu cần)
    
    # Chỉnh sửa thông tin (ví dụ sửa tên người dùng)
    name_input = driver.find_element(By.ID, "fullname")  # Giả định input có name="username"
    new_username = username + "_updated"
    name_input.clear()
    name_input.send_keys(new_username)
    
    # Nhấp vào nút lưu
    save_button = driver.find_element(By.CLASS_NAME, "confirm-btn")
    save_button.click()
    time.sleep(2)  # Chờ trang load lại
    
    # Kiểm tra xem thông tin đã được cập nhật chưa
    row_update = driver.find_element(By.CSS_SELECTOR, 'tr.data-row[data-uname="anhtai123"]') #Ví dụ lấy user đầu tiên "anhtai123" (có thể thay đổi)
    displayed_username = row_update.find_elements(By.CSS_SELECTOR, 'a[style="text-transform: none;"]')[1].text

    assert displayed_username == new_username, f"Displayed username '{displayed_username}' does not match expected '{new_username}'."

def test_update_with_empty_username(driver):
    login(driver, "quang", "12345678")
    time.sleep(2)

    # Điều hướng đến trang cần kiểm tra
    driver.find_element(By.XPATH, "/html/body/ul[1]/li[5]/a").click()
    driver.find_element(By.XPATH, "/html/body/div[2]/p[2]").click()
    time.sleep(2)

    # Tìm hàng đầu tiên để chỉnh sửa
    row = driver.find_element(By.CSS_SELECTOR, 'tr.data-row[data-uname="anhtai123"]')
    username = row.find_elements(By.CSS_SELECTOR, 'a[style="text-transform: none;"]')[1].text  # Lấy tên người dùng ban đầu
    
    # Nhấp vào nút chỉnh sửa
    edit_button = row.find_element(By.CLASS_NAME, "edit-btn")
    edit_button.click()
    time.sleep(2)  # Chờ modal hoặc form chỉnh sửa xuất hiện (nếu cần)
    
    # Xóa tên người dùng
    name_input = driver.find_element(By.ID, "fullname")
    name_input.clear()
    
    # Nhấp vào nút lưu
    save_button = driver.find_element(By.CLASS_NAME, "confirm-btn")
    save_button.click()
    time.sleep(2)  # Chờ trang load lại
    
    # Kiểm tra xem thông tin đã được cập nhật chưa
    row_update = driver.find_element(By.CSS_SELECTOR, f'tr.data-row[data-uname="anhtai123"]')  #Ví dụ lấy user đầu tiên "anhtai123" (có thể thay đổi)
    displayed_username = row_update.find_elements(By.CSS_SELECTOR, 'a[style="text-transform: none;"]')[1].text

    assert displayed_username == username, f"Displayed username '{displayed_username}' does not match expected '{username}'."

def test_edit_admin_role(driver):
    # Đăng nhập
    login(driver, "quang", "12345678")
    time.sleep(2)

    driver.find_element(By.XPATH, "/html/body/ul[1]/li[5]/a").click()
    driver.find_element(By.XPATH, "/html/body/div[2]/p[2]").click()
    time.sleep(2)

    # Tìm hàng đầu tiên cần chỉnh sửa
    row_to_edit = driver.find_element(By.CSS_SELECTOR, ".data-row")
    username = row_to_edit.get_attribute("data-uname")
    
    # Nhấp vào nút chỉnh sửa
    edit_button = row_to_edit.find_element(By.CLASS_NAME, "edit-btn")
    edit_button.click()

    # Sửa giá trị data-role
    role_input = driver.find_element(By.ID, "role")
    
    # Test với giá trị hợp lệ: "admin"
    role_input.clear()
    role_input.send_keys("admin")
    save_button = driver.find_element(By.CLASS_NAME, "confirm-btn")
    save_button.click()

    # Xác minh giá trị cập nhật chính xác
    WebDriverWait(driver, 10).until(
        EC.text_to_be_present_in_element_attribute((By.CSS_SELECTOR, f'.data-row[data-uname="{username}"]'), "data-role", "admin")
    )
    updated_row = driver.find_element(By.CSS_SELECTOR, f'.data-row[data-uname="{username}"]')
    assert updated_row.get_attribute("data-role") == "admin", "Failed to update data-role to 'admin'."
    # check chức năng admin cho tài khoản anhtai123
    login(driver, "anhtai123", "anhtai123")
    time.sleep(2)
    # Kiểm tra xem có hiển thị "Quản lý shop" hay không
    try:
        shop_management_link = driver.find_element(By.XPATH, "/html/body/ul[1]/li[5]/a")
        assert shop_management_link.is_displayed(), "Quản lý Shop link is not displayed."
    except Exception as e:
        assert False, f"Failed to find 'Quản lý Shop' link: {str(e)}"

def test_edit_normal_role(driver):
    # Đăng nhập
    login(driver, "quang", "12345678")
    time.sleep(2)

    driver.find_element(By.XPATH, "/html/body/ul[1]/li[5]/a").click()
    driver.find_element(By.XPATH, "/html/body/div[2]/p[2]").click()
    time.sleep(2)

    # Tìm hàng đầu tiên cần chỉnh sửa
    row_to_edit = driver.find_element(By.CSS_SELECTOR, ".data-row")
    username = row_to_edit.get_attribute("data-uname")
    
    # Nhấp vào nút chỉnh sửa
    edit_button = row_to_edit.find_element(By.CLASS_NAME, "edit-btn")
    edit_button.click()

    # Sửa giá trị data-role
    role_input = driver.find_element(By.ID, "role")
    
    # Test với giá trị hợp lệ: "admin"
    role_input.clear()
    role_input.send_keys("normal")
    save_button = driver.find_element(By.CLASS_NAME, "confirm-btn")
    save_button.click()

    # Xác minh giá trị cập nhật chính xác
    WebDriverWait(driver, 10).until(
        EC.text_to_be_present_in_element_attribute((By.CSS_SELECTOR, f'.data-row[data-uname="{username}"]'), "data-role", "admin")
    )
    updated_row = driver.find_element(By.CSS_SELECTOR, f'.data-row[data-uname="{username}"]')
    assert updated_row.get_attribute("data-role") == "normal", "Failed to update data-role to 'normal'."
    # check chức năng admin cho tài khoản anhtai123
    login(driver, "anhtai123", "anhtai123")
    time.sleep(2)
    # Kiểm tra xem có hiển thị "Quản lý shop" hay không
    try:
        shop_management_link = driver.find_element(By.XPATH, "/html/body/ul[1]/li[5]/a")
        assert not shop_management_link.is_displayed(), "Quản lý Shop link is displayed, but it should not be."
    except Exception as e:
        pass  # If element is not found, it is the expected behavior

def test_edit_user_role(driver):
    # Đăng nhập
    login(driver, "quang", "12345678")
    time.sleep(2)

    # Điều hướng đến trang quản lý
    driver.find_element(By.XPATH, "/html/body/ul[1]/li[5]/a").click()
    driver.find_element(By.XPATH, "/html/body/div[2]/p[2]").click()
    time.sleep(2)

    # Tìm hàng đầu tiên cần chỉnh sửa
    row_to_edit = driver.find_element(By.CSS_SELECTOR, ".data-row")
    username = row_to_edit.get_attribute("data-uname")
    
    # Nhấp vào nút chỉnh sửa
    edit_button = row_to_edit.find_element(By.CLASS_NAME, "edit-btn")
    edit_button.click()

    # Sửa giá trị data-role
    role_input = driver.find_element(By.ID, "role")
    
    # Dữ liệu nhập không hợp lệ
    invalid_role = "invalid_role"
    role_input.clear()
    role_input.send_keys(invalid_role)

    # Nhấn nút lưu
    save_button = driver.find_element(By.CLASS_NAME, "confirm-btn")
    save_button.click()

    # Chờ reload và kiểm tra giá trị sau khi lưu
    time.sleep(2)
    row_to_edit = driver.find_element(By.CSS_SELECTOR, f".data-row[data-uname='{username}']")
    saved_role = row_to_edit.get_attribute("data-role")

    # Assert
    assert saved_role in ["normal", "admin"], (
        f"Lỗi: Vai trò '{invalid_role}' không hợp lệ nhưng vẫn được lưu là '{saved_role}'."
    )

def test_block_user(driver):
    # Đăng nhập
    login(driver, "quang", "12345678")
    time.sleep(2)

    # Điều hướng đến trang quản lý
    driver.find_element(By.XPATH, "/html/body/ul[1]/li[5]/a").click()
    driver.find_element(By.XPATH, "/html/body/div[2]/p[2]").click()
    time.sleep(2)

    # Tìm hàng đầu tiên chứa user cần khóa
    row_to_lock = driver.find_element(By.CSS_SELECTOR, ".data-row[data-uname='anhtai123']")
    lock_button = row_to_lock.find_element(By.CLASS_NAME, "disable-btn")
    
    # Nhấn nút khóa user
    lock_button.click()
    time.sleep(2)

    # Chấp nhận hộp thoại confirm (nhấn OK)
    confirm_dialog = Alert(driver)
    confirm_dialog.accept()  # Nhấn nút "OK"
    time.sleep(2)

    # Thử đăng nhập lại với tài khoản đã bị khóa
    login(driver, "anhtai123", "anhtai123")
    time.sleep(2)

    # Kiểm tra xem có bị văng ra (giả sử sẽ quay lại trang login hoặc hiển thị thông báo lỗi)
    current_url = driver.current_url
    assert "login" in current_url or "Tài khoản đã bị khóa" in driver.page_source, ("User bị khóa nhưng vẫn đăng nhập thành công!")

def test_delete_normal_user(driver):
    # Đăng nhập
    login(driver, "quang", "12345678")
    time.sleep(2)

    # Điều hướng đến trang quản lý
    driver.find_element(By.XPATH, "/html/body/ul[1]/li[5]/a").click()
    driver.find_element(By.XPATH, "/html/body/div[2]/p[2]").click()
    time.sleep(2)

    # Tìm hàng đầu tiên chứa user cần xóa
    row_to_del = driver.find_element(By.CSS_SELECTOR, ".data-row")
    username_to_delete = row_to_del.get_attribute("data-uname")  # Lưu lại username để kiểm tra

    # Nhấp vào nút xóa
    del_button = row_to_del.find_element(By.CLASS_NAME, "delete-btn")
    del_button.click()
    time.sleep(1)

    # Xác nhận trong hộp thoại xóa
    confirm_button = driver.find_element(By.CLASS_NAME, "confirm-del-btn")
    confirm_button.click()
    time.sleep(2)

    # Tìm lại danh sách user để xác nhận user đã bị xóa
    user_list = driver.find_elements(By.CSS_SELECTOR, f".data-row[data-uname='{username_to_delete}']")

    # Assert rằng user không còn tồn tại trong danh sách
    assert len(user_list) == 0, f"User {username_to_delete} vẫn tồn tại sau khi xóa!"

