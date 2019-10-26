/** Order Deletion Confirmation */
$('.delete').click(function () {
    var res = confirm('Confirm the action!');
    if (!res) return false;
});

/** Order Editing */
$('.redact').click(function () {
    var res = confirm('You can only change the comment!');
    return false;
});

/** Confirmations deleting an order from the database */
$('.deletebd').click(function () {
    var res = confirm('Confirm the action!');
    if (res) {
        var ress = confirm('You will delete the order from the database!')
        if (!ress) return false;
    }
    if(!res) return false;
});
