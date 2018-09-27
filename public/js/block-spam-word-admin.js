function delete_row(id)
{
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == 'success')
            {
                var row=document.getElementById(id).parentNode.parentNode;
                row.parentNode.removeChild(row);
            }
        }
    };
    xmlhttp.open("POST","../wp-content/plugins/block-spam-word/admin/spam-word-delete.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("delete_row=true&spam_id=" + id);
}
