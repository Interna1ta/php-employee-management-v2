let grid = $("#jsGrid").jsGrid({
  width: "100%",
  height: "600px",
  inserting: true,
  pageLoading: true,
  editing: true,
  sorting: true,
  paging: true,
  autoload: true,
  pageSize: 10,
  pageButtonCount: 5,
  deleteConfirm: "Do you really want to delete data?",
  controller: {
    loadData: async function () {
      let items = await $.ajax({
        url: "printData",
        type: "GET",
        dataType: "json",
      });
      return { data: items };
    },
    insertItem: function (item) {
      return $.ajax({
        type: "POST",
        url: "printNewStudent",
        data: item,
      });
    },
    updateItem: function (item) {
      return $.ajax({
        type: "PUT",
        url: "printUpdates",
        data: item,
      });
    },
    deleteItem: function (item) {
      return $.ajax({
        type: "DELETE",
        url: "showDelete",
        data: {
          id: item.id,
          address_id: item.address_id,
        },
      });
    },
  },
  fields: [
    {
      name: "id",
      title: "ID",
      type: "hidden",
      css: "hide",
    },
    {
      name: "name",
      title: "Name",
      type: "text",
      headercss: "table__header",
      css: "table__row",
      width: 50,
      validate: "required",
    },
    {
      name: "email",
      title: "Email",
      type: "text",
      headercss: "table__header",
      css: "table__row",
      width: 80,
      validate: "required",
    },
    {
      name: "age",
      title: "Age",
      type: "number",
      headercss: "table__header",
      css: "table__row",
      width: 40,
      validate: function (value) {
        if (value > 0) {
          return true;
        }
      },
    },
    {
      name: "postalCode",
      title: "Postal code",
      type: "number",
      headercss: "table__header",
      css: "table__row",
      width: 40,
    },
    {
      name: "phoneNumber",
      title: "Phone number",
      type: "number",
      headercss: "table__header",
      css: "table__row",
      width: 60,
    },
    {
      name: "state",
      title: "State",
      type: "text",
      headercss: "table__header",
      css: "table__row",
      width: 50,
    },
    {
      name: "city",
      title: "City",
      type: "text",
      headercss: "table__header",
      css: "table__row",
      width: 60,
    },
    {
      name: "streetAddress",
      title: "Street address",
      type: "text",
      headercss: "table__header",
      css: "table__row",
      width: 40,
    },
    {
      type: "control",
      headercss: "table__header",
      css: "table__row",
      editButton: true,
      deleteButton: true,
      editButtonTooltip: "Edit",
      deleteButtonTooltip: "Delete",
      updateButtonTooltip: "Update",
      cancelEditButtonTooltip: "Cancel edit",
    },
  ],
  rowClick: function (args) {
    location.href = "../employee/showHTML/" + args.item.id;
  },
  // onItemUpdated: function () {
  //   let toast = document.getElementById("update-toast");
  //   toast.classList.remove("toast");
  //   setTimeout(() => {
  //     toast.classList.add("toast");
  //   }, 2000);
  // },
  // onItemDeleted: function () {
  //   let toast = document.getElementById("delete-toast");
  //   toast.classList.remove("toast");
  //   setTimeout(() => {
  //     toast.classList.add("toast");
  //   }, 2000);
  // },
});

$("#jsGrid").jsGrid("fieldOption", "id", "visible", false);

// let toast = document.getElementById("toast");
// if (toast) {
//   setTimeout(() => {
//     toast.remove();
//   }, 3000);
// }
