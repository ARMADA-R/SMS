<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">

        <div class="modal-dialog vertical-align-center modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">{{trans('admin.options')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">


                                                <div class="form-group">
                                                    <label>{{trans('')}}</label>
                                                    <p class="form-control-static" id="MEmail"></p>
                                                </div>


                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                        <div class="col-lg-6">
                                            <form>
                                            <div class="form-group">
                                                    <input class="inp-cbx" id="cbx" type="checkbox" style="display: none" />
                                                    <label class="cbx" for="cbx">
                                                        <span>
                                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </svg>
                                                        </span>
                                                        <span>CodePenChallenge</span>
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <input class="inp-cbx" id="cbx" type="checkbox" style="display: none" />
                                                    <label class="cbx" for="cbx">
                                                        <span>
                                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </svg>
                                                        </span>
                                                        <span>CodePenChallenge</span>
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <input class="inp-cbx" id="cbx" type="checkbox" style="display: none" />
                                                    <label class="cbx" for="cbx">
                                                        <span>
                                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </svg>
                                                        </span>
                                                        <span>CodePenChallenge</span>
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <input class="inp-cbx" id="cbx" type="checkbox" style="display: none" />
                                                    <label class="cbx" for="cbx">
                                                        <span>
                                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </svg>
                                                        </span>
                                                        <span>CodePenChallenge</span>
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <input class="inp-cbx" id="cbx" type="checkbox" style="display: none" />
                                                    <label class="cbx" for="cbx">
                                                        <span>
                                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </svg>
                                                        </span>
                                                        <span>CodePenChallenge</span>
                                                    </label>
                                                </div>



                                            </form>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('style')
<style>
    .vertical-alignment-helper {
        display: table;
        height: 100%;
        width: 100%;
        pointer-events: none;
    }

    .vertical-align-center {
        /* To center vertically */
        display: table-cell;
        vertical-align: middle;
        pointer-events: none;
    }

    .modal-content {
        /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
        width: inherit;
        max-width: inherit;
        /* For Bootstrap 4 - to avoid the modal window stretching
        full width */
        height: inherit;
        /* To center horizontally */
        margin: 0 auto;
        pointer-events: all;
    }

    .cbx {
        margin: auto;
        -webkit-user-select: none;
        user-select: none;
        cursor: pointer;
    }

    .cbx span {
        display: inline-block;
        vertical-align: middle;
        transform: translate3d(0, 0, 0);
    }

    .cbx span:first-child {
        position: relative;
        width: 18px;
        height: 18px;
        border-radius: 3px;
        transform: scale(1);
        vertical-align: middle;
        border: 1px solid #9098A9;
        transition: all 0.2s ease;
    }

    .cbx span:first-child svg {
        position: absolute;
        top: 3px;
        left: 2px;
        fill: none;
        stroke: #FFFFFF;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-dasharray: 16px;
        stroke-dashoffset: 16px;
        transition: all 0.3s ease;
        transition-delay: 0.1s;
        transform: translate3d(0, 0, 0);
    }

    .cbx span:first-child:before {
        content: "";
        width: 100%;
        height: 100%;
        background: #506EEC;
        display: block;
        transform: scale(0);
        opacity: 1;
        border-radius: 50%;
    }

    .cbx span:last-child {
        padding-left: 8px;
    }

    .cbx:hover span:first-child {
        border-color: #506EEC;
    }

    .inp-cbx:checked+.cbx span:first-child {
        background: #506EEC;
        border-color: #506EEC;
        animation: wave 0.4s ease;
    }

    .inp-cbx:checked+.cbx span:first-child svg {
        stroke-dashoffset: 0;
    }

    .inp-cbx:checked+.cbx span:first-child:before {
        transform: scale(3.5);
        opacity: 0;
        transition: all 0.6s ease;
    }

    @keyframes wave {
        50% {
            transform: scale(0.9);
        }
    }
</style>
@endpush

