import pytest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

@pytest.fixture
def driver():
    driver = webdriver.Edge()
    driver.maximize_window()
    yield driver
    driver.quit()

def login(driver):
    driver.get("http://localhost/ProjectWeb/login.html")
    driver.find_element(By.ID, "username").send_keys("quang")
    driver.find_element(By.ID, "password").send_keys("12345678")
    driver.find_element(By.XPATH, "//*[@id='login-form']/button").click()

def test_create_order(driver):
    login(driver)
    driver.execute_script("window.scrollBy(0, 600);")
    time.sleep(2)
    driver.find_element(By.XPATH, "//*[@id='boxajax-containter']/section[1]/div/div[1]/div[1]/a[1]").click()
    driver.execute_script("window.scrollBy(0, 300);")
    time.sleep(2)
    driver.find_element(By.XPATH, "/html/body/section[1]/div/button").click()
    time.sleep(2)
    driver.execute_script("window.scrollBy(0, -300);")
    time.sleep(2)
    driver.find_element(By.XPATH, "/html/body/div/div/a[3]/img").click()
    driver.find_element(By.XPATH, "//*[@id='Nam']").click()
    driver.find_element(By.ID, "sdt").send_keys("0908723456")
    driver.execute_script("window.scrollBy(0, 400);")
    time.sleep(2)
    selectAddress = driver.find_element(By.ID, "mySelect")
    s1 = Select(selectAddress)
    s1.select_by_value("25")
    driver.find_element(By.XPATH, "//*[@id='cod']").click()
    driver.find_element(By.XPATH, "//*[@id='billajax']/table/tbody/tr[4]/td[2]/button").click()
    time.sleep(2)
    driver.find_element(By.XPATH, "/html/body/ul[1]/li[1]/a").click()
    driver.find_element(By.XPATH, "/html/body/ul[1]/li[5]/a").click()
    driver.execute_script("window.scrollBy(0, 600);")
    time.sleep(2)
    driver.find_element(By.XPATH, "/html/body/div[3]/ul/li[6]/a").click()
    driver.execute_script("window.scrollBy(0, -300);")
    data = {
        "Khách Hàng": "Quang",
        "Thời Gian": "2024-11-12",
        "Thành Tiền": "1.400 USD",
        "Hình Thức Thanh Toán": "COD",
        "Địa Chỉ": "Lào Cai",
        "Tình Trạng Đơn": "Đang Đợi Xác Nhận"
    }
    assert data["Khách Hàng"] == "Quang", "Tên khách hàng không đúng"
    assert data["Thời Gian"] == "2024-11-12", "Thời gian không đúng"
    assert data["Thành Tiền"] == "1.400 USD", "Thành tiền không đúng"
    assert data["Hình Thức Thanh Toán"] == "COD", "Hình thức thanh toán không đúng"
    assert data["Địa Chỉ"] == "Lào Cai", "Địa chỉ không đúng"
    assert data["Tình Trạng Đơn"] == "Đang Đợi Xác Nhận", "Tình trạng đơn không đúng"

def test_confirm_order(driver):
    login(driver)
    time.sleep(2)
    driver.find_element(By.XPATH, "/html/body/ul[1]/li[5]/a").click()
    driver.execute_script("window.scrollBy(0, 600);")
    time.sleep(2)
    driver.find_element(By.XPATH, "/html/body/div[3]/ul/li[6]/a").click()
    driver.execute_script("window.scrollBy(0, -500);")
    time.sleep(2)
    # Tìm phần tử bằng XPath
    element = driver.find_element(By.XPATH, "/html/body/div[3]/div[4]/table/tbody/tr[2]/td[2]/a")
    
    # Lấy giá trị của thuộc tính data-id
    order_id = element.get_attribute("data-id")
    driver.find_element(By.XPATH, "/html/body/div[3]/div[4]/table/tbody/tr[2]/td[9]/button[2]").click()
    time.sleep(2)
    driver.find_element(By.XPATH, "/html/body/div[2]/p[1]").click()
    driver.find_element(By.XPATH, "/html/body/div[1]/div/a[2]/img").click()
    time.sleep(2)
    # Lấy trạng thái đơn hàng sau khi xác nhận
    order_status_element = driver.find_element(By.XPATH, "//*[@id='boxajax']/table/tbody/tr[2]/th[6]/p")
    assert "Đã Xử Lý" in order_status_element.text, f"Expected status 'Đã xử lý' for order #{order_id}, but got '{order_status_element.text}'"

def test_cancel_order(driver):
    login(driver)
    time.sleep(2)
    driver.find_element(By.XPATH, "/html/body/ul[1]/li[5]/a").click()
    driver.execute_script("window.scrollBy(0, 600);")
    time.sleep(2)
    driver.find_element(By.XPATH, "/html/body/div[3]/ul/li[6]/a").click()
    driver.execute_script("window.scrollBy(0, -500);")
    time.sleep(2)
    # Tìm phần tử bằng XPath
    element = driver.find_element(By.XPATH, "/html/body/div[3]/div[4]/table/tbody/tr[2]/td[2]/a")
    
    # Lấy giá trị của thuộc tính data-id
    order_id = element.get_attribute("data-id")
    driver.find_element(By.XPATH, "/html/body/div[3]/div[4]/table/tbody/tr[3]/td[9]/button[1]").click()
    time.sleep(2)
    driver.find_element(By.XPATH, "/html/body/div[2]/p[1]").click()
    driver.find_element(By.XPATH, "/html/body/div[1]/div/a[2]/img").click()
    time.sleep(2)
    # Lấy trạng thái đơn hàng sau khi hủy
    order_status_element = driver.find_element(By.XPATH, "//*[@id='boxajax']/table/tbody/tr[2]/th[6]/p")
    assert "Đã hủy" in order_status_element.text, f"Expected status 'Đã hủy' for order #{order_id}, but got '{order_status_element.text}'"

def test_order_and_location_filters(driver):
    login(driver)
    time.sleep(2)
    driver.find_element(By.XPATH, "/html/body/ul[1]/li[5]/a").click()
    driver.execute_script("window.scrollBy(0, 400);")
    time.sleep(2)
    
    order_filter = Select(driver.find_element(By.CLASS_NAME, "select-order"))
    order_filter.select_by_value("DESC")  # Select "mới nhất"
    time.sleep(2)  # Wait for results to load
    verify_filter_results(driver, filter_type="order", expected_value="mới nhất")
    
    # Step 4: Test filter by location (select "Lào Cai" and verify results)
    location_filter = Select(driver.find_element(By.CLASS_NAME, "select-location"))
    location_filter.select_by_value("Lào Cai")  # Select "Lào Cai"
    time.sleep(2)  # Wait for results to load
    verify_filter_results(driver, filter_type="location", expected_value="Lào Cai")
    
    # Step 5: Combine filters (e.g., "mới nhất" + "Lào Cai")
    order_filter.select_by_value("ASC")  # Select "mới nhất"
    location_filter.select_by_value("Lào Cai")  # Select "Lào Cai"
    time.sleep(2)  # Wait for results to load
    verify_combined_filter_results(driver, expected_order="mới nhất", expected_location="Lào Cai")
    
def verify_filter_results(driver, filter_type, expected_value):
    """
    Function to verify if the filter results match the expected value.
    """
    # Locate the result elements (assumes the results are displayed in a table or list)
    results = driver.find_elements(By.XPATH, "//div[@class='result-item']")  # Adjust the XPath to match your page
    for result in results:
        if filter_type == "order":
            # Verify the order of results (you may need to compare dates or IDs)
            assert "expected_date_or_order_criteria" in result.text, f"Order filter failed for {expected_value}"
        elif filter_type == "location":
            # Verify the location in each result
            assert expected_value in result.text, f"Location filter failed for {expected_value}"

def verify_combined_filter_results(driver, expected_order, expected_location):
    """
    Function to verify results when both filters are applied.
    """
    results = driver.find_elements(By.XPATH, "//div[@class='result-item']")  # Adjust the XPath
    for result in results:
        # Verify both order and location
        assert expected_order in result.text, f"Combined filter failed for order {expected_order}"
        assert expected_location in result.text, f"Combined filter failed for location {expected_location}"

def test_date_search(driver):
    login(driver)
    time.sleep(2)
    driver.find_element(By.XPATH, "/html/body/ul[1]/li[5]/a").click()
    time.sleep(2)

    from_date_input = driver.find_element(By.CLASS_NAME, "from-date")
    from_date_input.send_keys("01112024")

    to_date_input = driver.find_element(By.CLASS_NAME, "to-date")
    to_date_input.send_keys("30112024")

    confirm_button = driver.find_element(By.CLASS_NAME, "btn-search-date")
    confirm_button.click()
    time.sleep(2)

    WebDriverWait(driver, 10).until(
        EC.presence_of_all_elements_located((By.CSS_SELECTOR, ".data-row"))
    )

    # Step 4: Validate the dates in the search results
    rows = driver.find_elements(By.CSS_SELECTOR, ".data-row")
    for row in rows:
        # Extract the date text from the appropriate column
        date_element = row.find_element(By.XPATH, "./td[4]/a")
        order_date = date_element.text

        # Verify the date is within the selected range
        assert "2024-11-01" <= order_date <= "2024-11-30", f"Date {order_date} is out of range!"
    time.sleep(2)

    print("All results are within the selected date range.")