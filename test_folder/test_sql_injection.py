# from selenium import webdriver
# from selenium.webdriver.common.by import By
# import pytest

# @pytest.fixture
# def driver():
#     driver = webdriver.Edge()
#     driver.maximize_window()
#     yield driver
#     driver.quit()

# def test_sql_injection(driver):
#     driver.get("http://localhost/ProjectWeb/login.html")
    
#     # Test SQL injection on the login form
#     username_field = driver.find_element(By.ID, "username")
#     password_field = driver.find_element(By.ID, "password")
#     login_button = driver.find_element(By.XPATH, "//*[@id='login-form']/button")
    
#     # Input SQL injection payload
#     username_field.send_keys("' OR '1'='1")
#     password_field.send_keys("anything")
#     login_button.click()
    
#     # Check if login was successful (indicating a vulnerability)
#     assert "Bài tập thầy Thanh" not in driver.page_source, "SQL Injection vulnerability detected!"

from selenium import webdriver
from selenium.webdriver.common.by import By
import pytest
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

def sql_injection_payloads():
    return [
        # Payload bypass login
        "' OR '1'='1",
        "' OR '1'='1' --",
        "' OR '1'='1' /*",
        "' OR '1'='1' #",
        "' OR '1'='1' AND '1'='1",
        "' OR '1'='1' AND '1'='2",
        # Payload destructive
        "'; DROP TABLE users; --",
        # Payload UNION SELECT
        "' UNION SELECT null, @@version --",
        "' UNION SELECT NULL, user() --"
        "' UNION SELECT null, null, null --",
        "' UNION SELECT username, password FROM users --",
        "' UNION SELECT table_name, column_name FROM information_schema.columns --",
    ]

@pytest.mark.parametrize("payload", sql_injection_payloads())
def test_sql_injection_login(driver, payload):
    driver.get("http://localhost/ProjectWeb/login.html")
    
    # Test SQL injection on the login form
    username_field = driver.find_element(By.ID, "username")
    password_field = driver.find_element(By.ID, "password")
    login_button = driver.find_element(By.XPATH, "//*[@id='login-form']/button")
    
    # Input SQL injection payload
    username_field.send_keys(payload)
    password_field.send_keys("anything")
    login_button.click()
    
    # Check if login was successful (indicating a vulnerability)
    assert "Bài tập thầy Thanh" not in driver.page_source, f"SQL Injection vulnerability detected with payload: {payload}"

@pytest.mark.parametrize("payload", sql_injection_payloads())
def test_sql_injection_search(driver, payload):
    login(driver, "quang", "12345678")
    time.sleep(2)

    search_input = driver.find_element(By.XPATH, "/html/body/div[1]/div[2]/div/input")
    search_input.clear()
    search_input.send_keys(payload)

    search_button = driver.find_element(By.XPATH, "/html/body/div[1]/div[2]/div/button")
    search_button.click()

    # Xác định phần tử chính (order-page)
    order_page = driver.find_element(By.CLASS_NAME, "order-page")

    # Tìm tất cả thẻ div con bên trong order-page
    child_divs = order_page.find_elements(By.TAG_NAME, "div")
    assert len(child_divs) == 0, f"SQL Injection vulnerability detected in search with payload: {payload}"


if __name__ == "__main__": # hoặc chạy lệnh pytest test_folder/test_sql_injection.py
    pytest.main()