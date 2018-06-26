/**
 * Created by xtn on 2018/2/2.
 */
$(function () {
    var app_menu_parent=$('.app-menu-parent li');
    app_menu_parent.each(function () {
        if ($(this).hasClass('active')){
            $(this).parent().parent('li').addClass('active-sub active');
        }
    });
});
var config = {
    token: window.hcweb.csrfToken
};

/**
 * 根据id更新排序
 * @param url
 * @param id
 * @param value
 */
function updateOrderById(url, id, value) {
    $.post(url, {
        id: id,
        order: value,
        _token: config.token
    }).success(function (response) {
        if (response.success == true) {
            swal({
                title: '',
                text: response.msg,
                type: 'success',
                timer: 2000,
                showCancelButton: false,
                showConfirmButton: false
            });
            setTimeout(function () {
                window.location.href = window.location.href;
            }, 2000);

        } else {
            swal({
                title: '',
                text: response.msg,
                type: 'error',
                timer: 2000,
                showCancelButton: false,
                showConfirmButton: false
            })
        }
    }).error(function () {
        swal({
            title: '',
            text: '服务器错误！',
            type: 'error',
            timer: 2000,
            showCancelButton: false,
            showConfirmButton: false
        })
    });
}

/**
 * 删除
 * @param url
 * @param ids
 * @param title
 */
function deleteObj(url, ids, title) {
    swal({
            title: "您确定要删除" + title + "吗？",
            text: "删除后将无法恢复！",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#F55145",
            confirmButtonText: "确定删除",
            cancelButtonText: "取消删除",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {
                $.post(url + '/' + ids, {
                    _token: config.token,
                    _method: 'DELETE'
                }).success(function (response) {
                    if (response.success == true) {
                        swal({
                            title: '',
                            text: title + response.msg,
                            type: 'success',
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        }, 2000);

                    } else {
                        swal({
                            title: '',
                            text: title + response.msg,
                            type: 'error',
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                    }
                }).error(function () {
                    swal({
                        title: '',
                        text: '服务器错误！',
                        type: 'error',
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false
                    })
                });
            }
        });
}


//全选和取消全选
function choseAll() {
    var title = $(".toggleTitle span").text();
    if (title == "全选") {
        $(".toggleTitle span").text("取消");
        $("input[name='ids']").prop("checked", true);
    } else {
        $(".toggleTitle span").text("全选");
        $("input[name='ids']").prop("checked", false);
    }
}

//批量删除数据
function deleteMoreObject(url) {
    var ids = [];
    $('input[name="ids"]:checked').each(function () {
        ids.push($(this).val());
    });
    if (ids.length != 0) {
        swal({
            title: "您确定要删除所选项吗?",
            text: "删除后将不可恢复,请谨慎操作！",
            type: "error",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "确定删除",
            cancelButtonText: "取消删除",
            closeOnConfirm: true
        }, function (isConfirm) {
            if (isConfirm) {
                $.post(url + '/' + ids, {
                    _token: config.token,
                    _method: 'DELETE'
                }).success(function (response) {
                    if (response.success == true) {
                        swal({
                            title: '',
                            text: response.msg,
                            type: 'success',
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        }, 2000);

                    } else {
                        swal({
                            title: '',
                            text: response.msg,
                            type: 'error',
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                    }
                }).error(function () {
                    swal({
                        title: '',
                        text: '服务器错误！',
                        type: 'error',
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false
                    })
                });
            }
        });
    } else {
        swal({
            title: '',
            text: '请选择要删除的项目！',
            type: 'warning',
            timer: 2000,
            showCancelButton: false,
            showConfirmButton: false
        })
    }
}