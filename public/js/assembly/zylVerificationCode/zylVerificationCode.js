$(function(){
	zylVerCode();//鍒濆鍖栫敓鎴愰殢鏈烘暟
});


//鐢熸垚闅忔満鏁�
function zylVerCode(len){
    len = len || 4;
    var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';//榛樿鍘绘帀浜嗗鏄撴贩娣嗙殑瀛楃oOLl,9gq,Vv,Uu,I1
    var maxPos = $chars.length;
    var zylCode = '';
    for (i = 0; i < len; i++) {
        zylCode += $chars.charAt(Math.floor(Math.random() * maxPos));
    }
    $(".zylVerCode").html(zylCode);
}