<div id="filterbar" class="collapse">
    <div class="box border-bottom">
        <div class="box-label text-uppercase d-flex align-items-center">Filter<button class="btn ml-auto" type="button" data-toggle="collapse" data-target="#inner-box" aria-expanded="false" aria-controls="inner-box" id="out" onclick="outerFilter()"> <span class="fas fa-plus"></span> </button> </div>
        <select name="sort" id="sort">
            <option value="" hidden selected>Sort by</option>
            <option value="price">Price</option>
            <option value="popularity">Popularity</option>
            <option value="rating">Rating</option>
        </select>
    </div>
    <div class="box border-bottom">
        <div class="form-group text-center">
            <div class="btn-group" data-toggle="buttons"> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="radio"> Reset </label> <label class="btn btn-success form-check-label active"> <input class="form-check-input" type="radio" checked> Apply </label> </div>
        </div>
        <div> <label class="tick">New <input type="checkbox" checked="checked"> <span class="check"></span> </label> </div>
        <div> <label class="tick">Sale <input type="checkbox"> <span class="check"></span> </label> </div>
    </div>
    <div class="box border-bottom">
        <div class="box-label text-uppercase d-flex align-items-center">Outerwear <button class="btn ml-auto" type="button" data-toggle="collapse" data-target="#inner-box" aria-expanded="false" aria-controls="inner-box" id="out" onclick="outerFilter()"> <span class="fas fa-plus"></span> </button> </div>
        <div id="inner-box" class="collapse mt-2 mr-1">
            <div class="my-1"> <label class="tick">Windbreaker <input type="checkbox" checked="checked"> <span class="check"></span> </label> </div>
            <div class="my-1"> <label class="tick">Jumpsuit <input type="checkbox"> <span class="check"></span> </label> </div>
            <div class="my-1"> <label class="tick">Jacket <input type="checkbox"> <span class="check"></span> </label> </div>
            <div class="my-1"> <label class="tick">Coat <input type="checkbox"> <span class="check"></span> </label> </div>
            <div class="my-1"> <label class="tick">Raincoat <input type="checkbox"> <span class="check"></span> </label> </div>
            <div class="my-1"> <label class="tick">Handbag <input type="checkbox" checked> <span class="check"></span> </label> </div>
            <div class="my-1"> <label class="tick">Warm vest <input type="checkbox"> <span class="check"></span> </label> </div>
            <div class="my-1"> <label class="tick">Wallets <input type="checkbox" checked> <span class="check"></span> </label> </div>
        </div>
    </div>
    <div class="box border-bottom">
        <div class="box-label text-uppercase d-flex align-items-center">season <button class="btn ml-auto" type="button" data-toggle="collapse" data-target="#inner-box2" aria-expanded="false" aria-controls="inner-box2"><span class="fas fa-plus"></span></button> </div>
        <div id="inner-box2" class="collapse mt-2 mr-1">
            <div class="my-1"> <label class="tick">Spring <input type="checkbox" checked="checked"> <span class="check"></span> </label> </div>
            <div class="my-1"> <label class="tick">Summer <input type="checkbox"> <span class="check"></span> </label> </div>
            <div class="my-1"> <label class="tick">Autumn <input type="checkbox" checked> <span class="check"></span> </label> </div>
            <div class="my-1"> <label class="tick">Winter <input type="checkbox"> <span class="check"></span> </label> </div>
            <div class="my-1"> <label class="tick">Rainy <input type="checkbox"> <span class="check"></span> </label> </div>
        </div>
    </div>
    <div class="box border-bottom">
        <div class="box-label text-uppercase d-flex align-items-center">price <button class="btn ml-auto" type="button" data-toggle="collapse" data-target="#price" aria-expanded="false" aria-controls="price"><span class="fas fa-plus"></span></button> </div>
        <div class="collapse" id="price">
            <div class="middle">
                <div class="multi-range-slider"> <input type="range" id="input-left" min="0" max="100" value="10"> <input type="range" id="input-right" min="0" max="100" value="50">
                    <div class="slider">
                        <div class="track"></div>
                        <div class="range"></div>
                        <div class="thumb left"></div>
                        <div class="thumb right"></div>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-2">
                <div> <span id="amount-left" class="font-weight-bold"></span> uah </div>
                <div> <span id="amount-right" class="font-weight-bold"></span> uah </div>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-label text-uppercase d-flex align-items-center">size <button class="btn ml-auto" type="button" data-toggle="collapse" data-target="#size" aria-expanded="false" aria-controls="size"><span class="fas fa-plus"></span></button> </div>
        <div id="size" class="collapse">
            <div class="btn-group d-flex align-items-center flex-wrap" data-toggle="buttons"> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="checkbox"> 80 </label> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="checkbox" checked> 92 </label> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="checkbox" checked> 102 </label> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="checkbox" checked> 104 </label> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="checkbox" checked> 106 </label> <label class="btn btn-success form-check-label"> <input class="form-check-input" type="checkbox" checked> 108 </label> </div>
        </div>
    </div>
</div>