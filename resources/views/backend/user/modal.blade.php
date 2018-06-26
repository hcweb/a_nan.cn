<!-- Modal -->
<div class="modal fade" id="avatar-crop">
    <div class="modal-dialog" role="document">
        {!! Form::open(['route'=>'user.avatar.crop','onsubmit'=>'return false;','id'=>'cropForm']) !!}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="pci-cross pci-circle" style="margin-top: -5px;"></span>
                </button>
                <h4 class="modal-title" id="myModalLabel">头像剪裁</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="path" id="imgPth"/>
                <input type="hidden" name="cropx" id="cropx" value="0" />
                <input type="hidden" name="cropy" id="cropy" value="0" />
                <input type="hidden" name="cropw" id="cropw" value="0" />
                <input type="hidden" name="croph" id="croph" value="0" />
                <div id="app-crop-img">
                    <div id="interface">
                        <img src="" alt="" id="avatar-tmp">
                    </div>
                    <span class="app-img-thumb bord-all bg-gray-dark"></span>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="submit" class="btn btn-primary app-add-permission-btn">确定</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>