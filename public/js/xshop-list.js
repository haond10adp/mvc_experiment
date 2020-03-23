
// Check all, uncheck all
var btnCheckAll = document.getElementById("btn_checkAll");
var btnDelete = document.getElementById("btn-delete");
var checkBoxes = document.querySelectorAll('input[type=checkbox]');

btnCheckAll.addEventListener("change", function () {
    if (this.checked) {
        checkBoxes.forEach(checkBox => {
            checkBox.checked = true;
        });
    } else {
        checkBoxes.forEach(checkBox => {
            checkBox.checked = false;
        });
    }
});

checkBoxes.forEach(checkBox => {
    checkBox.addEventListener("change", function () {
        var checkedBoxes = document.querySelectorAll(":checked");
        if (checkedBoxes.length > 0) {
            btnDelete.style.boxShadow = "0 0 7px red";
        } else {
            btnDelete.style.boxShadow = "none";
        }
    });
});

btnDelete.addEventListener("click", function (event) {
    var checkedBoxes = document.querySelectorAll(":checked");
    if (checkedBoxes.length === 0) {
        alert("Vui lòng chọn ít nhất một mục!");
        event.preventDefault();
    } else {
        //Confirm deletion
        var sure = confirm('Bạn có chắc chắn muốn xóa không?');
        if (!sure) {
            event.preventDefault();
        }
    }
});

// Confirm deletion
var remove_items = document.querySelectorAll(".remove");
remove_items.forEach((remove_item) => {
    remove_item.addEventListener("click", function () {
        var sure = confirm('Bạn có chắc chắn muốn xóa không?');
        if (!sure) {
            event.preventDefault();
        }
    })
});




