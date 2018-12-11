// 表单提交
$(function () {
    var _form = $("#login-form");
    _form.submit(function () {
        var btn_submit = $("#btn-submit");
        btn_submit.attr("disabled", true);
        $(_form).ajaxSubmit({
            type: "post",
            dataType: "json",
            url: "/admin/passport/login",
            success: function (result) {
                btn_submit.attr("disabled", false);
                if (result.code === 1) {
                    layer.msg(result.msg, {time: 1500, anim: 1}, function () {
                        window.location = result.data.url;
                    });
                    return true;
                }
                layer.msg(result.msg, {time: 1500, anim: 6});
            }
        });
        return false;
    });
});