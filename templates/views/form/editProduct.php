<style>
    .container {
        background-color: #f2f2f2;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 50px;
    }

    label {
        font-size: 1.2em;
        font-weight: bold;
        color: #333;
    }

    input, textarea {
        font-size: 1.2em;
        padding: 10px;
        border-radius: 5px;
        border: none;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
        width: 100%;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .btn-primary {
        background-color: #333;
        color: #fff;
        font-size: 1.2em;
        padding: 15px;
        border-radius: 50px;
        border: none;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #fff;
        color: #333;
        cursor: pointer;
    }

</style>



<div class="container my-5">
    <h1 class="text-center font-weight-bold">Edit Product Data</h1>
    <form class="mt-5">
        <div class="form-group">
            <label for="productName">Product Name</label>
            <input type="text" class="form-control" id="productName" placeholder="Enter Product Name">
        </div>
        <div class="form-group">
            <label for="productDescription">Product Description</label>
            <textarea class="form-control" id="productDescription" rows="5" placeholder="Enter Product Description"></textarea>
        </div>
        <div class="form-group">
            <label for="productPrice">Product Price</label>
            <input type="number" class="form-control" id="productPrice" placeholder="Enter Product Price">
        </div>
        <div class="form-group">
            <label for="productImage">Product Image</label>
            <input type="file" class="form-control-file" id="productImage">
        </div>
        <button type="submit" class="btn btn-primary btn-block my-5">Save Changes</button>
    </form>
</div>
