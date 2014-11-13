/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 全局方法
 * @author martin QQ:629881438
 */
globals.Person = function(id){
    this.id = id;
};

/**
 * 获取form表单input和textarea值,组成ajax提交的data
 * @params form = new globals.Person('#advisory-form input,#advisory-form textarea');
 * @params var data = form.getArray();
 * @return {type} description
 */
globals.Person.prototype.getArray = function(){
    var data = new Array();
    $(this.id).each(function(i){
        data[i] = $(this).attr('name')+'='+$(this).val();
    });
    return  data.join('&');
};