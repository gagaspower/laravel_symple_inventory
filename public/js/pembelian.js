function recount_data( arrayTable ){
    //counting summary
    var total_cost = 0;

    for (i=0; i<=arrayTable.length-1; i++){
        var temp_table = arrayTable[i];
        console.log(arrayTable[i]);
        total_cost +=  ( temp_table.stok * numeral(temp_table.harga_pembelian).format('0.000') );
    }
    $("#item_total_cost").text(numeral(total_cost).format('0,0.00'));
}