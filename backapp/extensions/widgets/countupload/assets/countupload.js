/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function viewCount(url){
    this.url = url;
    this.push = function()
    {
        $.ajax({
            type: "GET",
            url: url,
            cache:false,
            dataType: "json"
          });
    };
}