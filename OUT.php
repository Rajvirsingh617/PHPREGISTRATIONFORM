<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple Options Select Menu</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<div class="col-3">
    <div class="select-btn">
        <span class="btn-text">Select Currency</span>
        <span class="arrow-dwn">
            <i class="fa-solid fa-chevron-down"></i>
        </span>
    </div>

    <ul class="list-items">
        <li class="item select-all">
            <span class="checkbox">
                <i class="fa-solid fa-check check-icon"></i>
            </span>
            <span class="item-text">Select All</span>
        </li>
        <li class="item">
            <span class="checkbox">
                <i class="fa-solid fa-check check-icon"></i>
            </span>
            <span class="item-text">USD - US Dollar</span>
        </li>
        <li class="item">
            <span class="checkbox">
                <i class="fa-solid fa-check check-icon"></i>
            </span>
            <span class="item-text">EUR - Euro</span>
        </li>
        <li class="item">
            <span class="checkbox">
                <i class="fa-solid fa-check check-icon"></i>
            </span>
            <span class="item-text">GBP - British Pound</span>
        </li>
        <li class="item">
            <span class="checkbox">
                <i class="fa-solid fa-check check-icon"></i>
            </span>
            <span class="item-text">JPY - Japanese Yen</span>
        </li>
        <li class="item">
            <span class="checkbox">
                <i class="fa-solid fa-check check-icon"></i>
            </span>
            <span class="item-text">AUD - Australian Dollar</span>
        </li>
        <li class="item">
            <span class="checkbox">
                <i class="fa-solid fa-check check-icon"></i>
            </span>
            <span class="item-text">CAD - Canadian Dollar</span>
        </li>
        <li class="item">
            <span class="checkbox">
                <i class="fa-solid fa-check check-icon"></i>
            </span>
            <span class="item-text">CHF - Swiss Franc</span>
        </li>
        <li class="item">
            <span class="checkbox">
                <i class="fa-solid fa-check check-icon"></i>
            </span>
            <span class="item-text">CNY - Chinese Yuan</span>
        </li>
        <li class="item">
            <span class="checkbox">
                <i class="fa-solid fa-check check-icon"></i>
            </span>
            <span class="item-text">INR - Indian Rupee</span>
        </li>
    </ul>
</div>

    <style>
        /* Google Fonts - Poppins */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background-color: #e3f2fd;
}

.container {
    position: relative;
    max-width: 320px;
    width: 100%;
    margin: 80px auto 30px;
}

.select-btn {
    display: flex;
    height: 50px;
    align-items: center;
    justify-content: space-between;
    padding: 0 16px;
    border-radius: 8px;
    cursor: pointer;
    background-color: #fff;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}

.select-btn .btn-text {
    font-size: 17px;
    font-weight: 400;
    color: #333;
}

.select-btn .arrow-dwn {
    display: flex;
    height: 21px;
    width: 21px;
    color: #fff;
    font-size: 14px;
    border-radius: 50%;
    background: #6e93f7;
    align-items: center;
    justify-content: center;
    transition: 0.3s;
}

.select-btn.open .arrow-dwn {
    transform: rotate(-180deg);
}

.list-items {
    position: relative;
    margin-top: 15px;
    border-radius: 8px;
    padding: 16px;
    background-color: #fff;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    display: none;
}

.select-btn.open ~ .list-items {
    display: block;
}

.list-items .item {
    display: flex;
    align-items: center;
    list-style: none;
    height: 50px;
    cursor: pointer;
    transition: 0.3s;
    padding: 0 15px;
    border-radius: 8px;
}

.list-items .item:hover {
    background-color: #e7edfe;
}

.item .item-text {
    font-size: 16px;
    font-weight: 400;
    color: #333;
}

.item .checkbox {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 16px;
    width: 16px;
    border-radius: 4px;
    margin-right: 12px;
    border: 1.5px solid #c0c0c0;
    transition: all 0.3s ease-in-out;
}

.item.checked .checkbox {
    background-color: #4070f4;
    border-color: #4070f4;
}

.checkbox .check-icon {
    color: #fff;
    font-size: 11px;
    transform: scale(0);
    transition: all 0.2s ease-in-out;
}

.item.checked .check-icon {
    transform: scale(1);
}
</style>

    <!-- JavaScript -->
    <script src="js/script.js"></script>
    <script>
const selectBtn = document.querySelector(".select-btn"),
    items = document.querySelectorAll(".item"),
    selectAll = document.querySelector(".select-all");

selectBtn.addEventListener("click", () => {
    selectBtn.classList.toggle("open");
    updateSelectAllStatus(); // Update the "Select All" checkbox status when dropdown opens
});

items.forEach(item => {
    item.addEventListener("click", () => {
        if (item !== selectAll) {
            item.classList.toggle("checked");
        }
        updateSelectAllStatus();
        updateButtonText();
    });
});

selectAll.addEventListener("click", () => {
    if (selectAll.classList.contains("checked")) {
        // Uncheck all items
        items.forEach(item => {
            if (item !== selectAll) {
                item.classList.remove("checked");
            }
        });
        selectAll.classList.remove("checked");
    } else {
        // Check all items
        items.forEach(item => {
            if (item !== selectAll) {
                item.classList.add("checked");
            }
        });
        selectAll.classList.add("checked");
    }
    updateButtonText();
});

// Function to update the "Select All" checkbox status
function updateSelectAllStatus() {
    const checkedItems = document.querySelectorAll(".item.checked");
    if (checkedItems.length === items.length - 1) { // Exclude "Select All"
        selectAll.classList.add("checked");
    } else {
        selectAll.classList.remove("checked");
    }
}

// Function to update the button text
function updateButtonText() {
    const checkedItems = document.querySelectorAll(".item.checked");
    let btnText = document.querySelector(".btn-text");

    if (checkedItems.length > 0) {
        btnText.innerText = `${checkedItems.length} Selected`;
    } else {
        btnText.innerText = "Select Language";
    }
}
</script>





</body>
</html>
