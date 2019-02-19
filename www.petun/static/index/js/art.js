

/*增加ivyClick事件*/
function ivyClick(id,ele){
    var _script = document.createElement("script");
    _script.className="spanclass";
    _script.type = "text/javascript";
    _script.src = "//count.pclady.com.cn/count.php?channel=" + id + "&screen="+ screen.width + "*" + screen.height+"&refer="+encodeURIComponent(document.referrer)+"&anticache="
    +new Date().getTime()+"&url="+encodeURIComponent(location.href)+"&from=event";  
    if ($(".spanclass")) {
        $(".spanclass").remove();
        document.getElementsByTagName("head")[0].appendChild(_script);
    }else{
        document.getElementsByTagName("head")[0].appendChild(_script);
    };

  var _this=$("span",ele);
  _this.addClass("cur").parent().removeAttr("onclick").siblings().removeAttr("onclick");

  /*增加点击提示*/
  var fhtml=$(".artFeel").html();
  var tipBox=_this.parent().parent();
  var ind=_this.parent().index();
  var tip;
  if (ind==0) {
    tip="<div class='cTip'>哇 今天小编有鸡腿啦！</div>";  
  }else if(ind==1){
    tip="<div class='cTip'>我真的没有打动你么？</div>"; 
  }else{
    tip="<div class='cTip'>求求你告诉我哪里做错了（T_T）</div>"; 
  };
  $(".artFeel").html(fhtml+tip);
}

function ivyClick_media(id,ele){
    var _script = document.createElement("script");
    _script.className="media_ivyClick";
    _script.type = "text/javascript";
    _script.src = "//count.pclady.com.cn/count.php?channel=" + id + "&screen="+ screen.width + "*" + screen.height+"&refer="+encodeURIComponent(document.referrer)+"&anticache="
    +new Date().getTime()+"&url="+encodeURIComponent(location.href)+"&from=event";  
    document.getElementsByTagName("head")[0].appendChild(_script);
}

//替换slide.scroll的图片
function replceSrc(target,type){
  var imgs = target.getElementsByTagName("img");
  if(!imgs) return;
  for(var i=0,len=imgs.length;i<len;i++){
    var img = imgs[i];
    if(img.getAttribute(type) && !img.getAttribute('loaded')){
      img.src = img.getAttribute(type);
      img.setAttribute('loaded','true');
    }
  } 
}

/**
 * 全局滚动图JS（2px边框）
 * notbind 参数用于接触通用配置
 */
(function(){
    $("#Jwrapper").find(".slide-pic").each(function(i,slide){
        var auto=!!$(this).attr("auto"),
            merge=$(this).attr("isMerge"),
            config_stay = $(this).attr("stay")*1 || 3000;
        if (merge=="false") {
            merge=false;
        }else{
            merge=true;
        };
        if (!$(this).attr("notHov")) {
            $(this).hover(function(){
                $(this).addClass("slide-pic-hover");
            },function(){
                $(this).removeClass("slide-pic-hover");
            })
        };

        if ($(this).attr("controlPic")) {
            var control=$('.pic-ctrl  .item',slide)||false; 
        }else{
            var control=$('.circle-ctrl  .item',slide)||false;  
        }
        new Slide({
            target: $( '.slide-wrap li',slide),
            control:  control,
            prevBtn: $('.prev',slide),
            nextBtn: $('.next',slide),
            effect: 'slide',
            merge : merge,
            stay:config_stay,
            // animateTime:config_animateTime,
            autoPlay : auto,
            onchange : function(){
                var index = this.curPage;
                if(this.config.merge) {
                    index = index % this.length;
                }
                var img = $(this.target)[index];
                replceSrc(img,"src2");
            }
        })       
    });
})();

(function(){
    // top10模块
    $("#Jwrapper").find(".topList").each(function(){
        var _this=$(this);
        if (!_this.attr("notHov")) {
            _this.find(".ol-txt li").hover(function(){
                $(this).addClass("cur").siblings().removeClass("cur");
            });
        };  
    })
})();

(function(){
  var whiteList = ["1545963","1518973","1547035","1547789","1548873","1573919","1573934"];
  for (var i = 0; i < whiteList.length; i++) {
    if(window.location.href.indexOf(whiteList[i])> -1){
      !!$("#editor_baidu") && $("#editor_baidu").remove();
      !!$(".editor") && $(".editor").remove();
      
    }
  }
})();
/**
 * 全局通用切换JS
 * notbind 参数用于接触通用配置
 */
function exeTab(obj){
  $("#"+obj).find(".tab-nav").each(function(i,tab){
    if(!$(tab).attr("notbind")){
      var auto = $(tab).attr("data-auto");  
      new Slide({
          target: $('.pannel',tab),
          control: $('.control .item',tab),
        // autoPlay : true,
        // stay: 3000,
        onchange : function(){
          replceSrc(this.target[this.curPage],'src2');
        }
      }); 
    }
  })
}
exeTab("Jwrapper");

window.onscroll = function(){
    var n = $("#Jguide"), 
      l = document.body.clientWidth, 
    m = document.body.scrollTop ? document.body.scrollTop : document.documentElement.scrollTop,
    isPrepend=$("#Jguide .wxMa");
    if (!isPrepend.length) {
        //添加微信logo
        $("#Jguide .guide-wrap").prepend('<a href="javascript:;" class="wxMa"><div class="s_ma"><div class="s_ma_cont"><img src="//www1.pclady.com.cn/global/2016/images/ladyIndex/wx_pclady.jpg" height="148" width="150"><span>关注官方微信</span></div><em></em></div></a>');
    };
    if (m < n.attr("stop") || l <= 1200) {
        n.fadeOut();
    } else {
        n.fadeIn();
    }
 
}

/* 底部添加轮播图*/
if($('#downLoadSeo-pic').length>0){
new Slide({
    target: $('#downLoadSeo-pic li'),
    effect: 'fade',
    autoPlay: true,
    stay:3000
});}
//add by xiexiaoshan 20170706 start
function replceSrc(target, type) {
  if(target && target.getElementsByTagName("img")){
    var imgs = target.getElementsByTagName("img");
    for (var i = 0,len = imgs.length; i < len; i++) {
      if (imgs[i].getAttribute(type)) {
        imgs[i].src = imgs[i].getAttribute(type);
        imgs[i].removeAttribute(type);
      }
    }
  }
}
if($( '#slide03 li' ).length>4){//产品超过4个切换效果
  $(".relatepro").show();
  $( '#slide03' ).width('1228px');
  new Slide({
    target: $( '#slide03 li' ),
    width: 307,
    merge: true,
    effect: 'slide',
    prevBtn: $(".relatepro .prev"),
    nextBtn: $(".relatepro .next"),
    onchange: function(){
      var tarimg = document.getElementById('slide03');
      replceSrc(tarimg, "#src");
    }
  });

$(".relatepro .btn").bind('click',function(event) {
  var img=new Image;
  var tagid=172;
  img.src="//count.pclady.com.cn/count.php?channel="+tagid+"&screen="+screen.width+"*"+screen.height+"&refer="+encodeURIComponent(document.referrer)+"&anticache="+new Date().getTime()+"&url="+encodeURIComponent(location.href)+"&from=event";

});

  $("#slide03").hover(function(){
    $(".relatepro .prev").stop(true).animate({"left":"0"},300);
    $(".relatepro .next").stop(true).animate({"right":"0"},300);
  },function(){
    $(".relatepro .prev").stop(true).animate({"left":"-40px"},300);
    $(".relatepro .next").stop(true).animate({"right":"-40px"},300);
  })
}else if($( '#slide03 li' ).length <= 0){//没有产品
  $(".relatepro").hide();
}else{//产品小于5个
  $(".relatepro").show();
  var autoWidth = $( '#slide03 li' ).length*$( '#slide03 li' ).width();
  $('#slide03').width(autoWidth);
  $("#slide03 ul").width(autoWidth+$( '#slide03 li' ).length);
}
//menu
var showtime = 500;//动画效果时间
$("#Jclose").bind('click',function(){
  closeList();
})
$(".relatetit").bind('click mouseenter',function(){
  $(".relatetit").hasClass('closeList') ? closeList() : openList();
})
//menu hide
function closeList(){
  $("#slide03").animate({"left":"-1330px"},showtime);
  $(".relatetit").addClass('openList').removeClass('closeList');
}
//menu show
function openList(){
  $("#slide03").animate({"left":"50px"},showtime);
  $(".relatetit").removeClass('openList').addClass('closeList');
}
//add by xiexiaoshan 20170706 end