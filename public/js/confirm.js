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