let itemContainer = $('#item-list'),itemMore=$('.am-add-more');
let itemIndex=1;
function addItem(){
    let itemGroup  ='<div class="am-g am-space-rem" id="item-id-'+itemIndex+'">' +
        '<div class="am-u-sm-3"><input type="text" name="item[][item]" placeholder="项描述"></div>'+
        '<div class="am-u-sm-1 input-select" data-item-id="'+itemIndex+'"><input type="text" name="item[][brand]" placeholder="请选择"></div>'+
        '<div class="am-u-sm-1"><input type="text" name="item[][spec]" placeholder="规格"></div>'+
        '<div class="am-u-sm-1"><input type="text" name="item[][nums]" placeholder="数量"></div>'+
        '<div class="am-u-sm-1"><input type="text" name="item[][area]" placeholder="面积"></div>'+
        '<div class="am-u-sm-1"><input type="text" name="item[][unit]" placeholder="单价"></div>'+
        '<div class="am-u-sm-1"><input type="text" name="item[][total]" placeholder="总价"></div>'+
        '<div class="am-u-sm-2"><input type="text" name="item[][remarks]" placeholder="备注"></div>'+
        '<div class="am-u-sm-1"><span class="am-close" onclick="removeItem('+itemIndex+')">&times;</span>'+
        '</div>';
    itemMore.before(itemGroup);
    itemIndex = Number(itemIndex)+1
}
//移除项
function removeItem(e){
    $('#item-id-'+e).remove()
}
let selectItemId;
$(function(){
    $(document).on('click','.input-select',function(){
        im.modal('#selectBrand');
        selectItemId = $(this).data('item-id');
        console.log(selectItemId);
    })
});