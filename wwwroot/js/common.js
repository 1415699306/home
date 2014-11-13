/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * LeFeel全局JS,统一合并部署文件
 * @author martin QQ:629881438
 * 
 * 示例
 * 注册命名空间
 * LeFeel.register('showMsg');
 * 在命名空间里声明window类
 * showMsg.window = function(name,age){this.name = name;this.age  = age;};
 * 给window添加一个公共方法show();
 * showMsg.window.prototype.show = function(){alert(this.name+this.age);};
 * var p = new showMsg.window('martin',25);
 * p.show();
 */
/**
 * 声明全局对像LeFeel,注册命名空间
 * 
 * @type Object
 */
LeFeel = new Object();

/**
 * 全局对象仅仅存在register函数，参数为名称空间全路径，如"showMsg.GEA"
 *  
 * @param {type} fullNS
 * @returns {undefined}
 */
LeFeel.register = function(fullNS){
   /*将命名空间切成N部分, showMsg、GEA等*/
    var nsArray = fullNS.split('.');
    var sEval = "";
    var sNS = "";
    for (var i = 0; i < nsArray.length; i++)
    {
        if (i !== 0) sNS += ".";
        sNS += nsArray[i];
       /*依次创建构造命名空间对象（假如不存在的话）的语句*/
       /*比如先创建showMsg，然后创建showMsg.GEA，依次下去*/
        sEval += "if (typeof(" + sNS + ") == 'undefined') " + sNS + " = new Object();";
    }
    if (sEval !== "") eval(sEval);
};

/**
 * 注册showMsg对象
 */
LeFeel.register('globals');
LeFeel.register('showMsg');