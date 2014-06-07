(function(){
    function change_part(t){
        var self = $(t);
        var type = self.data('type');
        console.log(self);
        $.post('/s/ajax_part.php',
               {
                   aid: self.data('aid'),
                   type: type,
               },
               function(data){
                   if(data == '1'){
                       if(type=='add') self.text('取消报名').data('type', 'remove').removeClass('btn-success');
                       else self.text('报名').data('type', 'add').addClass('btn-success');
                   }else alert('操作失败！');
               }, 'text');
    };
    function change_coll(t){
        var self = $(t);
        var type = self.data('type');
        $.post('/s/ajax_coll.php',
               {
                   aid: self.data('aid'),
                   type: type,
               },
               function(data){
                   if(data == '1'){
                       if(type=='add') self.text('取消收藏').data('type', 'remove').removeClass('btn-success');
                       else self.text('收藏').data('type', 'add').addClass('btn-success');
                   }else alert('操作失败！');
               }, 'text');
    };
    function change_star(t){
        var self = $(t);
        var type = self.data('type');
        $.post('/s/ajax_star.php',
               {
                   uid: self.data('uid'),
                   type: type,
               },
               function(data){
                   if(data == '1'){
                       if(type=='add') self.text('取消关注').data('type', 'remove').removeClass('btn-success');
                       else self.text('关注').data('type', 'add').addClass('btn-success');
                   }else alert('操作失败！');
               }, 'text');
    };
	function change_belong(t){
        var self = $(t);
        var type = self.data('type');
        $.post('/s/ajax_belong.php',
               {
                   uid: self.data('uid'),
                   type: type,
               },
               function(data){
                   if(data == '1'){
                       if(type=='add') self.text('退出该社团').data('type', 'remove').removeClass('btn-success');
                       else self.text('加入社团').data('type', 'add').addClass('btn-success');
                   }else alert('操作失败！');
               }, 'text');
    };
    window.change_part = change_part;
    window.change_coll = change_coll;
    window.change_star = change_star;
	window.change_belong = change_belong;
})();
