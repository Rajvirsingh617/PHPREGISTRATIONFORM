@extends('layouts.main.app')

@section('head')
@include('layouts.main.headersection', ['title' => 'Add SMPP Supplier'])
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
    width: 50%;
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

@endsection

@section('content')
<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header p-3">
                <h4 class="card-title text-center">{{ __('Add SMPP Supplier') }}</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('admin.smpp_supplier.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Name Field -->
                            <div class="col-3">
                                <div class="mb-1">
                                    <label for="name" class="form-label required">Name <span class="text-danger">*</span></label>
                                    <input type="text" id="name" value="{{ old('name') }}" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" required placeholder="Required" autofocus oninput="this.value = this.value.toUpperCase()">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>                                    
                            </div>
                            <!-- IP Field -->
                            <div class="col-3">
                                <div class="mb-1">
                                    <label for="ip" class="form-label required">IP <span class="text-danger">*</span></label>
                                    <input type="text" name="ip" value="{{ old('ip') }}" class="form-control form-control-sm @error('ip') is-invalid @enderror">
                                    @error('ip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Port Field -->
                            <div class="col-3">
                                <div class="mb-1">
                                    <label for="port" class="form-label required">Port <span class="text-danger">*</span></label>
                                    <input type="text" name="port" value="{{ old('port') }}" class="form-control form-control-sm" required placeholder="2775">
                                </div>
                            </div>

                            <!-- System ID Field -->
                            <div class="col-3">
                                <div class="mb-1">
                                    <label for="system_id" class="form-label required">System ID <span class="text-danger">*</span></label>
                                    <input type="text" name="system_id" value="{{ old('system_id') }}" class="form-control form-control-sm" required placeholder="Required">
                                </div>
                            </div>

                            <!-- Password Field with Generator Button -->
                            <div class="col-3">
                                <div class="mb-1">
                                    <label for="password" class="form-label required">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="password" id="password" class="form-control form-control-sm @error('password') is-invalid @enderror" required placeholder="Required">
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Balance Field -->
                            <div class="col-3">
                                <div class="mb-1">
                                    <label for="balance" class="form-label required">Balance <span class="text-danger">*</span></label>
                                    <input type="text" name="balance" value="{{ old('balance', 0) }}" class="form-control form-control-sm" required placeholder="Required">
                                </div>
                            </div>

                            <!-- Currency Dropdown -->
                            <div class="col-3">
                            <div class="select-btn">
            <span class="btn-text">Select</span>
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
                            </div>

                            <!-- Supplier Capacity -->
                            <div class="col-3">
                                <div class="mb-1">
                                    <label for="supplier_capacity" class="form-label required">Supplier Capacity (sms/sec) <span class="text-danger">*</span></label>
                                    <input type="text" name="supplier_capacity" value="{{ old('supplier_capacity') }}" class="form-control form-control-sm" required placeholder="Number">
                                </div>
                            </div>

                            <!-- No. of Connections -->
                            <div class="col-3">
                                <div class="mb-1">
                                    <label for="no_of_connections" class="form-label required">No. of connections <span class="text-danger">*</span></label>
                                    <input type="text" name="no_of_connections" value="{{ old('no_of_connections', 0) }}" class="form-control form-control-sm" required placeholder="Number">
                                </div>
                            </div>

                            <!-- Enquire_link_resptimeout -->
                            <div class="col-3">
                                <div class="mb-1">
                                    <label for="enquire_link_resptimeout_sec" class="form-label required">Enquire_link_resptimeout, sec. <span class="text-danger">*</span></label>
                                    <input type="text" name="enquire_link_resptimeout_sec" value="{{ old('enquire_link_resptimeout_sec', 0) }}" class="form-control form-control-sm" required placeholder="Number">
                                </div>
                            </div>
                        </div>

                        <!-- Limitations Section -->
                        <div class="row mt-4" style="border-top: 1px solid #ccc; padding-top: 10px;">
                            <div class="col-12">
                                <h5 class="font-weight-bold">{{ __('Limitations') }}</h5>
                                <div class="custom-control custom-checkbox mb-3">
                                    <input class="custom-control-input" id="customCheck2" type="checkbox" checked="">
                                    <label class="custom-control-label" for="customCheck2">Reject too long messages</label>
                                </div>
                            </div>
                        </div>

                        <!-- Vendor Capacity and Buffer -->
                        <div class="row">
                            <div class="col-3">
                                <div class="mb-1">
                                    <label for="vendor_capacity" class="form-label required">Vendor Capacity (sms/sec) <span class="text-danger">*</span></label>
                                    <input type="text" name="vendor_capacity" id="vendor_capacity" value="{{ old('vendor_capacity', 20) }}" class="form-control form-control-sm" required placeholder="Required">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-1">
                                    <label for="vendor_buffer" class="form-label required">Vendor Overflow Buffer Size <span class="text-danger">*</span></label>
                                    <input type="text" name="vendor_buffer" value="{{ old('vendor_buffer', 20) }}" class="form-control form-control-sm" required placeholder="Required">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-12 text-center mt-3">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // Example: Adding a password generator (optional)
    document.getElementById('generatePasswordBtn').addEventListener('click', function() {
        var password = Math.random().toString(36).slice(-8);  // Generates a random 8-character password
        document.getElementById('password').value = password;
    });
</script>
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
@endsection
