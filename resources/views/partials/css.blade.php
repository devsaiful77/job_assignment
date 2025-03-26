{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

{{-- Google Fonts --}}
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

{{-- css --}}
<link rel="stylesheet" href="{{ asset('content/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('content/css/AdminLTE.min.css') }}">
<link rel="stylesheet" href="{{ asset('content/css/_all-skins.min.css') }}">
<link rel="stylesheet" href="{{ asset('content/css/bootstrap3-wysihtml5.min.css') }}">
<link rel="stylesheet" href="{{ asset('content/css/sweetalert2.css') }}">
<link rel="stylesheet" href="{{ asset('content/css/other.css') }}">
<link rel="stylesheet" href="{{ asset('content/css/custom.css') }}">

<style>

    :root {
        --bg-primary-color: #2A3042;
    }
    .product_variant_list {
        list-style-type: none;
        margin-bottom: 0px;
        padding-top: 10px;
    }

    .product_variant_list li {
        display: inline-block;
        padding: 3px 55px;
    }

 
    .v_check {
        min-width: 10%;
        float: left;
        margin: 3px 3px;
    }


    .v_check_name {
        position: absolute;        
        font-size: 18px;        
        font-weight: normal;
        margin-left: 8px;
        margin-top: -2px;
    }

    .v_check_label {
        padding-top: 6px;
    }

    label {
        font-size: 14px !important;
        color: #000;
        font-weight: 400;
    }

    .list_title {
    font-size: 18px;
    margin-left: 6px;
    text-transform: capitalize;
}



    .sale_product_item_preview>img {
        max-width: 70px;
        max-height: 70px;
    }

    .v-card.v-sheet.theme--light {
        padding: 10px !important;
    }


    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }

    .custom_popup_card {
        padding-bottom: 0 !important
    }

    .custom_popup_container {
        padding-bottom: 0 !important;
    }


    .search-content {
        max-height: 600px;
        overflow-y: auto;
        margin-top: 20px;
    }

    ::-webkit-scrollbar {
        height: 4px;
    }

    input[type='text'],
    input[type='number'],
    select {
        height: 40px !important;
    }

    input.form-control {
    margin-bottom: 10px;
    }
    select.form-control{
        margin-bottom: 10px;
    }

    .form-group{
        margin-bottom: 0px !important;
    }

    .box-body table thead tr th {
        white-space: nowrap;
    }

    

    .box-body{
        overflow-x: auto;
    }

    .box-body .row {
        margin-right: 0px !important;
        margin-left: 0px !important;
    }



    /* custom code  */
    
    input.form-control {
    margin-bottom: 10px;
    }
    select.form-control{
        margin-bottom: 10px;
    }

    .form-group{
        margin-bottom: 0px !important;
    }

    .box-body table thead tr th {
        white-space: nowrap;
    }

    

    .box-body{
        overflow-x: auto;
    }

    .box-body .row {
        margin-right: 0px !important;
        margin-left: 0px !important;
    }

	 .box-body_card{
 	      padding: 12px;
    }







    .product_search_list {
        width: 100%;
        max-height: 350px;
        height: auto;
        overflow-y: auto;
        list-style-type: none;
  
    }

    .product_search_list>li {
        cursor: pointer;
        border-bottom: 1px solid rgba(0, 0, 0, .08);
    }

    .__search_p_content {
        display: flex;
        margin-left: 8px
    }
    input.v_check_input {
    transform: scale(1.5);
    cursor: pointer;
}

    .__search_p_content>img {
        width: 80px;
        height: 80px;
        margin: 5px 10px;
    }




    .vm--modal {
        position: relative;
        overflow: hidden;
        box-sizing: border-box;
        background-color: white;
        border-radius: 3px;
        box-shadow: 0 20px 60px -2px rgba(27, 33, 58, 0.4);
        overflow-y: scroll !important;
    }


    .combo_p_list {
        list-style-type: disc;
        display: flex;
        flex-wrap: wrap;
        margin-top: 28px;
    }

    .combo_p_list>li {
        margin: 0px 25px;
        background: black;
        padding: 2px 24px;
        color: #fff;
        margin-bottom: 10px;
    }

    .combo_p_list>li>span {
        cursor: pointer;
        background: red;
        position: absolute;
        width: 39px;
        height: 24px;
        margin-top: -2px;
        margin-left: 20px;
    }

    .combo_p_list>li>span>i {
        margin: 5px 14px;
    }



    .container {
        width: 100% !important;
    }

    .is-invalid {
        border: 1px solid red;
    }

    .invalid-feedback {
        color: red;
    }

    .swal2-popup {
        width: 24em !important;
        font-size: 1.2em !important;
    }

    .swal2-styled.swal2-confirm {

        font-size: 1.0625em;
    }

    .small-image {
        width: 50px;
        border: 1px solid #000;
    }

    .router-link-exact-active {
        border: 1.4px dashed #fff !important;
        /* padding: 0px !important */
    }

    .text-danger {
        color: red !important;
    }

    span.badge-danger {
        background: red;
    }

    span.badge-success {
        background: green;
    }

    span.badge-warning {
        background: #f39c12;
        color: #000 !important;
    }

    span.badge-primary {
        background: #3c8dbc;
    }

    .table td {
        border: 1px solid #ddd;

    }

    .table th {
        background-color: #ddd;

    }

    .login {
        display: none !important;
    }

    .table-image {
        width: 100px;
        height: 95px
    }

    .barcode {
        margin-bottom: 0px;
    }

    .barcode-number {
        margin-left: 40px;
    }

    .two-percent {
        width: 2% !important;
    }

    .three-percent {
        width: 3% !important;
    }

    .action-btn {
        width: 70px !important;
        margin-bottom: 2px !important;
    }

    li.dropdown a {
        color: #fff !important;
    }

    li.dropdown a:hover {
        color: #000 !important;
    }

    .invoice-header {
        text-align: left;
        display: none;
    }

    .invoice-header .address {
        margin-top: 6px;
        text-align: right;
        position: absolute;
        right: 50px;

    }

    .invoice-header .address p {
        margin: 0 0px;
        font-weight: bolder;

    }

    .invoice-body {
        margin-bottom: 30px;
    }

    .invoice-body p {
        margin: 0 0px;
    }

    .toasted.toasted-primary.success {
        width: 400px;
        height: 55px;
        font-size: 18px;
    }


    .toasted.toasted-primary.error {
        width: 400px;
        height: 55px;
        font-size: 18px;
        font-weight: bolder;
    }

    .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred {
        height: 200px !important;
    }

    .permisson-denied {
        text-align: center;

    }

    .permisson-denied img {
        border: 5px solid red;
        border-radius: 9px;
    }


    .order_statistic {
        margin-left: 10px;
    }

    .statistic_item {
        float: left;
        background: #fff;
        box-shadow: 0 1pt 4pt rgb(150 165 237);
        border: none;
        padding: 1px 40px;
        margin: 5px;
        width: 24%;
        height: 98px;
    }

    .order-input-margin-top {
        margin-top: 20px !important;
        margin-bottom: 20px !important;
    }

    .statistic_item h2 {
        font-size: 34px;
        font-weight: bold;
        font-family: serif;
        line-height: 23px;
        color: #000;
    }

    .statistic_item p {
        font-size: 16px;
        font-family: serif;
        /* position: absolute; */
        line-height: 13px;
        color: #000;
    }

    .status_img_icon {
        margin-top: -40px;
        float: right;
        width: 50px;
    }

    .action_container {
        display: none;
    }


    .toggle_order_action {
        display: block;
    }


    .sidebar-menu li>a>.pull-right-container>i {
        font-size: 15px !important;
        font-weight: bold;
    }

    .v_stock_preview {
        position: absolute;
        margin-top: 4px;
        width: 50px;
        background: green;
    }

    .qty_stock {
        width: 70px;
    }

    .common_space {
        margin-bottom: 5px;
    }

    .p_content {
        margin-bottom: 0px;
    }


    .product_preview_container {
        margin-top: 30px;
    }


    .product_child_container {
        margin-left: 15%;
    }

    .product_child_container img {
        width: 200px;
        height: 200px;
    }

    .product_child_container p {
        font-size: 16px;
    }


    .orders_p_container>img {
        max-width: 40px;
        max-height: 40px;
    }


    .box-body_card{
        padding: 12px;
    }




    /* Add Order page code start  */
    
    .admin_header_title {
        color:  black ;
        padding: 10px 0;
        text-align: center;
        margin-bottom: 20px;
        box-shadow: 0px 3px 9px -3px rgba(0,0,0,0.1);
        background-color: white;
       
    }
    
    /* .box-header{
        padding: 0px 10px !important;
    } */

    .header_title_container {
        padding: 15px;
    }

    .box-title {
        font-size: 20px;
    }



    .order_manner_img {
        width: 70px;
    }

    .order_manner_img img {
        width: 100%;
        height: 100%;
    }


    .statistic_item {
    display: flex;
    align-items: center;
    justify-content: space-between;
}


   .d_p_transaction_container{
     background: #fff ;
     min-height: 500px; 
     
   }


   
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 20px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: 0.4s;
  transition: 0.4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: 0px;
  bottom: 0px;
  background-color: #fff;
  -webkit-transition: 0.4s;
  transition: 0.4s;
}

input:checked+.slider {
  background-color: mediumseagreen;
}

input:focus+.slider {
  box-shadow: 0 0 1px mediumseagreen;
}

input:checked+.slider:before {
  -webkit-transform: translateX(20px);
  -ms-transform: translateX(20px);
  transform: translateX(20px);
}


.form-group-table table {
    width: 100%;
    margin-bottom: 16px;
}


.form-group-table table, th, td {
  border: 1px solid #ddd;
  padding: 10px
}


/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

   


    @media only screen and (max-width:1470px) {
        .qty_stock {
            width: 35px;
        }
    }


    @media only screen and (max-width:1270px) {
        .qty_stock {
            width: 35px;
        }

        .custom_select {
            padding: 0px !important;
            width: 60px;
        }

        .statistic_item {
            float: left;
            background: #fff;
            box-shadow: 0 1pt 4pt rgb(150 165 237);
            border: none;
            padding: 1px 40px;
            margin: 5px;
            width: 23.5%;
            height: 98px;
        }
    }


    @media only screen and (max-width:1200px) {

        .col-lg-11 {
            width: 105.666667% !important;
            margin-left: -5% !important;
            overflow-x: auto;
        }

        .box-body table tbody tr td {
            white-space: nowrap;
        }

        .order_search_container{
            margin-top: 10px;
        }



    }

    @media only screen and (max-width:992px) {
        .statistic_item {
            float: left;
            background: #fff;
            box-shadow: 0 1pt 4pt rgb(150 165 237);
            border: none;
            padding: 1px 40px;
            margin: 5px;
            width: 31.5%;
            /* height: 75px; */
        }
    }


    @media only screen and (max-width:820px) {
        .statistic_item {
            float: left;
            background: #fff;
            box-shadow: 0 1pt 4pt rgb(150 165 237);
            border: none;
            padding: 1px 40px;
            margin: 5px;
            width: 47.5%;
            /* height: 75px; */
        }
    }



    @media screen and (max-width:768px) {

        div#app {
            background: #fff !important;
        }

        .col-lg-11,
        .col-md-11,
        .col-lg-10,
        .col-md-10,
        .col-lg-6,
        .col-md-8,
        .col-lg-6,
        .col-md-6 {
            overflow-x: auto;
        }

        .order_statistic a {
            width: 45%;
            height: 100px;
            padding: 10px 20px;
        }

        .order_manner_img{
            width: 36px;
        }

    }


    /* SideBar Css */
    .border {
        border-left: 4px solid #0ba518;
    }

    .v-application--is-ltr .v-list-item__action:first-child,
    .v-application--is-ltr .v-list-item__icon:first-child {
        margin-right: 10px;
    }

    .v-list-group__items {
        margin-left: 5px !important;
    }

    .v-list-item {
        align-items: center;
        display: flex;
        flex: 1 1 100%;
        letter-spacing: normal;
        min-height: 48px;
        outline: none;
        padding: 0 16px;
        position: relative;
        text-decoration: none;
    }

    span.sidebar-menu-icon i {
        height: 35px;
        width: 35px;
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(70, 77, 235, 0.05);
        line-height: 35px;
        text-align: center;
        color: #fff;
        font-size: 14px;
    }

    span.sidebar-menu-icon {
        margin-right: 10px;
        line-height: 35px;
    }

    .custom_dropdown_router_link,
    .custom_router_link {
        display: block;
        width: 100%;
        color: #999999 !important;
        transition: all ease 0.3s;
        font-size: 15px;
        font-weight: bold
    }

    i.v-icon.notranslate.material-icons.theme--light {
        color: #999999 !important;
    }

    .custom_router_sub_link {
        padding-left: 15px;
        padding-top: 5px;
        padding-bottom: 5px;
        display: block;
        width: 100%;
        margin: 5px 0px;
        transition: all ease .3s;
        font-size: 14px;
        color: #fff !important;
    }

    .custom_router_sub_link:hover {
        background: #000;
    }


    .btn {
        color: #fff !important
    }

    
    .ql-editor>p>img {
    max-width: 400px !important; 
    max-height: 100% !important;
    }


</style>
