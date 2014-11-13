var g_selProvince;
var g_selCity;
var Provinces=new Array(new Array("110000","北京市"),new Array("120000","天津市"),new Array("130000","河北省"),new Array("140000","山西省"),new Array("150000","内蒙古自治区"),new Array("210000","辽宁省"),new Array("220000","吉林省"),new Array("230000","黑龙江省"),new Array("310000","上海市"),new Array("320000","江苏省"),new Array("330000","浙江省"),new Array("340000","安徽省"),new Array("350000","福建省"),new Array("360000","江西省"),new Array("370000","山东省"),new Array("410000","河南省"),new Array("420000","湖北省"),new Array("430000","湖南省"),new Array("440000","广东省"),new Array("450000","广西壮族自治区"),new Array("460000","海南省"),new Array("500000","重庆市"),new Array("510000","四川省"),new Array("520000","贵州省"),new Array("530000","云南省"),new Array("540000","西藏自治区"),new Array("610000","陕西省"),new Array("620000","甘肃省"),new Array("630000","青海省"),new Array("640000","宁夏回族自治区"),new Array("650000","新疆维吾尔自治区"),new Array("710000","台湾省"),new Array("810000","香港特别行政区"),new Array("820000","澳门特别行政区"));
var Citys=new Array(new Array("110000","北京市"),new Array("110100","市辖区"),new Array("110101","东城区"),new Array("110102","西城区"),new Array("110105","朝阳区"),new Array("110106","丰台区"),new Array("110107","石景山区"),new Array("110109","门头沟区"),new Array("110111","房山区"),new Array("110112","通州区"),new Array("110113","顺义区"),new Array("110114","昌平区"),new Array("110115","大兴区"),new Array("110117","平谷区"),new Array("110116","怀柔区"),new Array("110228","密云县"),new Array("110229","延庆县"),new Array("110103","崇文区"),new Array("110104","宣武区"),new Array("110108","海淀区"),new Array("120000","天津市"),new Array("120101","和平区"),new Array("120110","东丽区"),new Array("120102","河东区"),new Array("120111","西青区"),new Array("120103","河西区"),new Array("120112","津南区"),new Array("120104","南开区"),new Array("120113","北辰区"),new Array("120105","河北区"),new Array("120114","武清区"),new Array("120106","红桥区"),new Array("120107","塘沽区"),new Array("120108","汉沽区"),new Array("120109","大港区"),new Array("120221","宁河县"),new Array("120223","静海县"),new Array("120115","宝坻"),new Array("120225","蓟县"),new Array("130101","石家庄"),new Array("130201","唐山"),new Array("130301","秦皇岛"),new Array("130701","张家口"),new Array("130801","承德"),new Array("131001","廊坊"),new Array("130401","邯郸"),new Array("130501","邢台"),new Array("130601","保定"),new Array("130901","沧州"),new Array("133001","衡水"),new Array("130304","北戴河区"),new Array("130305","北戴河区"),new Array("130221","丰润县"),new Array("140101","太原"),new Array("140201","大同"),new Array("140301","阳泉"),new Array("140501","晋城"),new Array("140601","朔州"),new Array("142201","忻州"),new Array("142331","离石"),new Array("142401","榆次"),new Array("142601","临汾"),new Array("142701","运城"),new Array("140401","长治"),new Array("150101","呼和浩特"),new Array("150201","包头"),new Array("150301","乌海"),new Array("152601","集宁"),new Array("152701","东胜"),new Array("152801","临河"),new Array("152921","阿拉善左旗"),new Array("150401","赤峰"),new Array("152301","通辽"),new Array("152502","锡林浩特"),new Array("152101","海拉尔"),new Array("152201","乌兰浩特"),new Array("210101","沈阳"),new Array("210201","大连"),new Array("210301","鞍山"),new Array("210401","抚顺"),new Array("210501","本溪"),new Array("210701","锦州"),new Array("210801","营口"),new Array("210901","阜新"),new Array("211101","盘锦"),new Array("211201","铁岭"),new Array("211301","朝阳"),new Array("211401","锦西"),new Array("210601","丹东"),new Array("220101","长春"),new Array("220201","吉林"),new Array("220301","四平"),new Array("220401","辽源"),new Array("220601","浑江"),new Array("222301","白城"),new Array("222401","延吉"),new Array("220501","通化"),new Array("230101","哈尔滨"),new Array("230301","鸡西"),new Array("230401","鹤岗"),new Array("230501","双鸭山"),new Array("230701","伊春"),new Array("230801","佳木斯"),new Array("230901","七台河"),new Array("231001","牡丹江"),new Array("232301","绥化"),new Array("230201","齐齐哈尔"),new Array("230601","大庆"),new Array("232601","黑河"),new Array("232700","加格达奇"),new Array("310101","黄浦"),new Array("310103","卢湾"),new Array("310104","徐汇"),new Array("310105","长宁"),new Array("310106","静安"),new Array("310107","普陀"),new Array("310108","闸北"),new Array("310109","虹口"),new Array("310110","杨浦"),new Array("310112","闵行"),new Array("310113","宝山"),new Array("310114","嘉定"),new Array("310115","浦东"),new Array("310116","金山"),new Array("310100","松江"),new Array("310118","青浦"),new Array("310119","南汇"),new Array("310120","奉贤"),new Array("310230","崇明县"),new Array("320101","南京"),new Array("320201","无锡"),new Array("320301","徐州"),new Array("320401","常州"),new Array("320501","苏州"),new Array("320600","南通"),new Array("320701","连云港"),new Array("320801","淮阴"),new Array("320901","盐城"),new Array("321001","扬州"),new Array("321101","镇江"),new Array("330101","杭州"),new Array("330201","宁波"),new Array("330301","温州"),new Array("330401","嘉兴"),new Array("330501","湖州"),new Array("330601","绍兴"),new Array("330701","金华"),new Array("330801","衢州"),new Array("330901","舟山"),new Array("332501","丽水"),new Array("332602","临海"),new Array("340101","合肥"),new Array("340201","芜湖"),new Array("340301","蚌埠"),new Array("340401","淮南"),new Array("340501","马鞍山"),new Array("340601","淮北"),new Array("340701","铜陵"),new Array("340801","安庆"),new Array("341001","黄山"),new Array("342101","阜阳"),new Array("342201","宿州"),new Array("342301","滁州"),new Array("342401","六安"),new Array("342501","宣州"),new Array("342601","巢湖"),new Array("342901","贵池"),new Array("350101","福州"),new Array("350201","厦门"),new Array("350301","莆田"),new Array("350401","三明"),new Array("350501","泉州"),new Array("350601","漳州"),new Array("352101","南平"),new Array("352201","宁德"),new Array("352601","龙岩"),new Array("360101","南昌"),new Array("360201","景德镇"),new Array("362101","赣州"),new Array("360301","萍乡"),new Array("360401","九江"),new Array("360501","新余"),new Array("360601","鹰潭"),new Array("362201","宜春"),new Array("362301","上饶"),new Array("362401","吉安"),new Array("362502","临川"),new Array("370101","济南"),new Array("370201","青岛"),new Array("370301","淄博"),new Array("370401","枣庄"),new Array("370501","东营"),new Array("370601","烟台"),new Array("370701","潍坊"),new Array("370801","济宁"),new Array("370901","泰安"),new Array("371001","威海"),new Array("371100","日照"),new Array("372301","滨州"),new Array("372401","德州"),new Array("372501","聊城"),new Array("372801","临沂"),new Array("372901","菏泽"),new Array("410101","郑州"),new Array("410201","开封"),new Array("410301","洛阳"),new Array("410401","平顶山"),new Array("410501","安阳"),new Array("410601","鹤壁"),new Array("410701","新乡"),new Array("410801","焦作"),new Array("410901","濮阳"),new Array("411001","许昌"),new Array("411101","漯河"),new Array("411201","三门峡"),new Array("412301","商丘"),new Array("412701","周口"),new Array("412801","驻马店"),new Array("412901","南阳"),new Array("413001","信阳"),new Array("420101","武汉"),new Array("420201","黄石"),new Array("420301","十堰"),new Array("420400","沙市"),new Array("420501","宜昌"),new Array("420601","襄樊"),new Array("420701","鄂州"),new Array("420801","荆门"),new Array("422103","黄州"),new Array("422201","孝感"),new Array("422301","咸宁"),new Array("422421","江陵"),new Array("422801","恩施"),new Array("430101","长沙"),new Array("430401","衡阳"),new Array("430501","邵阳"),new Array("432801","郴州"),new Array("432901","永州"),new Array("430801","大庸"),new Array("433001","怀化"),new Array("433101","吉首"),new Array("430201","株洲"),new Array("430301","湘潭"),new Array("430601","岳阳"),new Array("430701","常德"),new Array("432301","益阳"),new Array("432501","娄底"),new Array("440101","广州"),new Array("440301","深圳"),new Array("441501","汕尾"),new Array("441301","惠州"),new Array("441601","河源"),new Array("440601","佛山"),new Array("441801","清远"),new Array("441901","东莞"),new Array("440401","珠海"),new Array("440701","江门"),new Array("441201","肇庆"),new Array("442001","中山"),new Array("440801","湛江"),new Array("440901","茂名"),new Array("440201","韶关"),new Array("440501","汕头"),new Array("441401","梅州"),new Array("441701","阳江"),new Array("450101","南宁"),new Array("450401","梧州"),new Array("452501","玉林"),new Array("450301","桂林"),new Array("452601","百色"),new Array("452701","河池"),new Array("452802","钦州"),new Array("450201","柳州"),new Array("450501","北海"),new Array("460100","海口"),new Array("460200","三亚"),new Array("510101","成都"),new Array("513321","康定"),new Array("513101","雅安"),new Array("513229","马尔康"),new Array("510301","自贡"),new Array("500100","重庆"),new Array("512901","南充"),new Array("510501","泸州"),new Array("510601","德阳"),new Array("510701","绵阳"),new Array("510901","遂宁"),new Array("511001","内江"),new Array("511101","乐山"),new Array("512501","宜宾"),new Array("510801","广元"),new Array("513021","达县"),new Array("513401","西昌"),new Array("510401","攀枝花"),new Array("500239","黔江土家族苗族自治县"),new Array("520101","贵阳"),new Array("520200","六盘水"),new Array("522201","铜仁"),new Array("522501","安顺"),new Array("522601","凯里"),new Array("522701","都匀"),new Array("522301","兴义"),new Array("522421","毕节"),new Array("522101","遵义"),new Array("530101","昆明"),new Array("530201","东川"),new Array("532201","曲靖"),new Array("532301","楚雄"),new Array("532401","玉溪"),new Array("532501","个旧"),new Array("532621","文山"),new Array("532721","思茅"),new Array("532101","昭通"),new Array("532821","景洪"),new Array("532901","大理"),new Array("533001","保山"),new Array("533121","潞西"),new Array("533221","丽江纳西族自治县"),new Array("533321","泸水"),new Array("533421","中甸"),new Array("533521","临沧"),new Array("540101","拉萨"),new Array("542121","昌都"),new Array("542221","乃东"),new Array("542301","日喀则"),new Array("542421","那曲"),new Array("542523","噶尔"),new Array("542621","林芝"),new Array("610101","西安"),new Array("610201","铜川"),new Array("610301","宝鸡"),new Array("610401","咸阳"),new Array("612101","渭南"),new Array("612301","汉中"),new Array("612401","安康"),new Array("612501","商州"),new Array("612601","延安"),new Array("612701","榆林"),new Array("620101","兰州"),new Array("620401","白银"),new Array("620301","金昌"),new Array("620501","天水"),new Array("622201","张掖"),new Array("622301","武威"),new Array("622421","定西"),new Array("622624","成县"),new Array("622701","平凉"),new Array("622801","西峰"),new Array("622901","临夏"),new Array("623027","夏河"),new Array("620201","嘉峪关"),new Array("622102","酒泉"),new Array("630100","西宁"),new Array("632121","平安"),new Array("632221","门源回族自治县"),new Array("632321","同仁"),new Array("632521","共和"),new Array("632621","玛沁"),new Array("632721","玉树"),new Array("632802","德令哈"),new Array("640101","银川"),new Array("640201","石嘴山"),new Array("642101","吴忠"),new Array("642221","固原"),new Array("650101","乌鲁木齐"),new Array("650201","克拉玛依"),new Array("652101","吐鲁番"),new Array("652201","哈密"),new Array("652301","昌吉"),new Array("652701","博乐"),new Array("652801","库尔勒"),new Array("652901","阿克苏"),new Array("653001","阿图什"),new Array("653101","喀什"),new Array("654101","伊宁"),new Array("710001","台北"),new Array("710002","基隆"),new Array("710020","台南"),new Array("710019","高雄"),new Array("710008","台中"),new Array("211001","辽阳"),new Array("653201","和田"),new Array("542200","泽当镇"),new Array("542600","八一镇"),new Array("820000","澳门"),new Array("810000","香港"));

function FillProvinces(selProvince)
{
    selProvince.options[0]=new Option("请选择","000000");
    for(i=0;i<Provinces.length;i++)
    {
        selProvince.options[i+1]=new Option(Provinces[i][1],Provinces[i][0]);
    }
    selProvince.options[0].selected=true;
    selProvince.length=i+1;
}

function FillCitys(selCity,ProvinceCode)
{
    //if the province is a direct-managed city, like Beijing, shanghai, tianjin, chongqin,hongkong, macro
    //need not "请选择选项"
    if(ProvinceCode=="110000"||ProvinceCode=="120000"||ProvinceCode=="310000"
         ||ProvinceCode=="810000"||ProvinceCode=="820000"||ProvinceCode=="500000")
       count=0;
    else
        {selCity.options[0]=new Option("请选择",ProvinceCode);
        count=1;}
    for(i=0;i<Citys.length;i++)
    {
        if(Citys[i][0].toString().substring(0,2)==ProvinceCode.substring(0,2))
        {
            selCity.options[count]=new Option(Citys[i][1],Citys[i][0]);
            count=count+1;
        }
    }
    selCity.options[0].selected=true;
    selCity.length=count;
}

function Province_onchange()
{
    FillCitys(g_selCity,g_selProvince.value);
}

function InitCitySelect(selProvince,selCity)
{
    //alert("begin");
    g_selProvince=selProvince;
    g_selCity=selCity;
    selProvince.onchange=Function("Province_onchange();");
    FillProvinces(selProvince);
    Province_onchange();
}
function InitCitySelect2(selProvince,selCity,CityCode)
{
    InitCitySelect(selProvince,selCity)
    for(i=0;i<selProvince.length;i++)
    {
        if(selProvince.options[i].value.substring(0,2)==CityCode.substring(0,2))
        {
            selProvince.options[i].selected=true;
        }
    }
    Province_onchange();
    for(i=0;i<selCity.length;i++)
    {
        if(selCity.options[i].value==CityCode)
        {
            selCity.options[i].selected=true;
        }
    }
}