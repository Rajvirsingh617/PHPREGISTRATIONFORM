<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Multi-Select Dropdown</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 10px;
        }
        .multi-select-container {
            position: relative;
            width: 270px;
        }
        .multi-select {
            display: block;
            width: 50%;
            padding: 8px;
            border: 2px solid #ccc;
            border-radius: 5px;
            background: #fff;
            cursor: pointer;
        }
        .dropdown-options {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 1000;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #fff;
            max-height: 100px;
            overflow-y: auto;
            display: none;
            width: 150px;
        }
        .dropdown-options.active {
            display: block;
        }
        .dropdown-options label {
            display: flex;
            align-items: center;
            padding: 3px 5px;
            cursor: pointer;
        }
        .dropdown-options label:hover {
            background: #f1f1f1;
        }
        .dropdown-options input[type="checkbox"] {
            margin-right: 10px;
        }
        .selected-text {
            color: #555;
        }
    </style>
</head>
<body>

<!-- Currency Dropdown with Multi-Select -->
<div class="col-3">
    <div class="mb-1">
        <label for="currency" class="form-label required" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
            Currency <span class="text-danger">*</span>
        </label>
        <div class="multi-select-container">
            <div class="multi-select" id="multiSelectCurrency">
                <span class="selected-text">Select currencies</span>
                <span style="float: right;">&#x25BC;</span>
            </div>
            <div class="dropdown-options" id="dropdownCurrencyOptions">
                <label><input type="checkbox" id="selectAllCurrencies"> Select All</label>
                <label><input type="checkbox" value="USD"> USD - US Dollar</label>
                <label><input type="checkbox" value="EUR"> EUR - Euro</label>
                <label><input type="checkbox" value="GBP"> GBP - British Pound</label>
                <label><input type="checkbox" value="JPY"> JPY - Japanese Yen</label>
                <label><input type="checkbox" value="AUD"> AUD - Australian Dollar</label>
                <label><input type="checkbox" value="CAD"> CAD - Canadian Dollar</label>
                <label><input type="checkbox" value="CHF"> CHF - Swiss Franc</label>
                <label><input type="checkbox" value="CNY"> CNY - Chinese Yuan</label>
                <label><input type="checkbox" value="INR"> INR - Indian Rupee</label>
            </div>
        </div>
    </div>
</div>

<script>
    const multiSelectCurrency = document.getElementById('multiSelectCurrency');
    const dropdownCurrencyOptions = document.getElementById('dropdownCurrencyOptions');
    const currencyCheckboxes = dropdownCurrencyOptions.querySelectorAll('input[type="checkbox"]:not(#selectAllCurrencies)');
    const selectAllCurrencies = document.getElementById('selectAllCurrencies');
    const selectedCurrencyText = multiSelectCurrency.querySelector('.selected-text');

    // Toggle dropdown visibility
    multiSelectCurrency.addEventListener('click', () => {
        dropdownCurrencyOptions.classList.toggle('active');
    });

    // Update selected text when checkboxes are clicked
    currencyCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateCurrencySelection);
    });

    // "Select All" functionality
    selectAllCurrencies.addEventListener('change', () => {
        const isChecked = selectAllCurrencies.checked;
        currencyCheckboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
        updateCurrencySelection();
    });

    // Update the selected text based on checked items
    function updateCurrencySelection() {
        const selected = Array.from(currencyCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.parentElement.textContent.trim());
        
        // Update "Select All" checkbox based on individual selections
        const allChecked = selected.length === currencyCheckboxes.length;
        selectAllCurrencies.checked = allChecked;

        selectedCurrencyText.textContent = selected.length
            ? selected.join(', ')
            : 'Select currencies';
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!multiSelectCurrency.contains(e.target) && !dropdownCurrencyOptions.contains(e.target)) {
            dropdownCurrencyOptions.classList.remove('active');
        }
    });
</script>


</body>
</html>
