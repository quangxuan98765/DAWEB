from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.alert import Alert
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import pytest
import time

@pytest.fixture
def driver():
    driver = webdriver.Edge()
    driver.maximize_window()
    yield driver
    driver.quit()

def xss_payloads():
    return [
        "<script>alert('XSS')</script>",
        "<img src=x onerror=alert('XSS')>",
        "<svg onload=alert('XSS')>",
        "<body onload=alert('XSS')>",
        "<iframe src=javascript:alert('XSS')>",
        "<input type=text value=<script>alert('XSS')></script>>",
        "<a href=javascript:alert('XSS')>Click me</a>",
        "';alert('XSS');//",
        "\";alert('XSS');//",
        "'><script>alert('XSS')</script>",
        "'><img src='x' onerror='alert(1)'>",
        "'><div onmouseover='alert(1)'>mouseover</div>",
        '"<script>alert(1)</script>',
        "\"><script>alert('XSS')</script>"
    ]

@pytest.mark.parametrize("payload", xss_payloads())
def test_xss_injection(driver, payload):
    driver.get("http://localhost/ProjectWeb/login.html")
    
    # Login to the application
    username_field = driver.find_element(By.ID, "username")
    password_field = driver.find_element(By.ID, "password")
    login_button = driver.find_element(By.XPATH, "//*[@id='login-form']/button")
    
    username_field.send_keys("quang")
    password_field.send_keys("12345678")
    login_button.click()
    
    time.sleep(2)  # Wait for login to complete
    
    # Test XSS injection on the search input
    search_input = driver.find_element(By.XPATH, "/html/body/div[1]/div[2]/div/input")
    search_input.clear()
    search_input.send_keys(payload)
    
    search_button = driver.find_element(By.XPATH, "/html/body/div[1]/div[2]/div/button")
    search_button.click()
    
    time.sleep(2)  # Wait for the search results to load
    
    # Kiểm tra nếu alert() đã được kích hoạt
    try:
        # Chờ xem alert có xuất hiện hay không
        alert = WebDriverWait(driver, 2).until(EC.alert_is_present())
        alert_text = alert.text
        assert "XSS" not in alert_text, f"XSS vulnerability detected with payload: {payload}"
        alert.accept()  # Đóng alert nếu có
    except:
        pass  # Không có alert xuất hiện, đây là kết quả mong đợi nếu XSS được bảo vệ
    
    # Kiểm tra xem payload có bị mã hóa không
    page_source = driver.page_source
    print(page_source)
    assert f"{payload}" not in page_source, f"XSS vulnerability detected with payload: {payload} (encoded)"

if __name__ == "__main__":
    pytest.main()