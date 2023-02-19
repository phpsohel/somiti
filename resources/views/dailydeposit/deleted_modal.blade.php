            <!---Modal start----->
            <div class="modal" id="myModal{{ $deposit->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Delete item</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="{{ route('yearlydeposite.destroy',$deposit->id) }}" method="post">


                            @csrf
                            @method("DELETE")
                            <!-- Modal body -->
                            <div class="modal-body">
                                Are you sure to delete ?
                                <input type="hidden" value="{{ $deposit->id }}" name="id">

                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success btn-sm">Yes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            </div>
            <!---Modal end----->
