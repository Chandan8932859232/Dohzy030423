                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-dark">Actions</button>
                            <button type="button" class="btn btn-outline-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin.loan-details',$application->id)}}"> View Loan Details</a>
                                <a class="dropdown-item" href="{{ route('admin.loan-approve', $application->id)}}"> Approve Loan </a>
                                <a class="dropdown-item" href="{{ route('admin.loan-sent', $application->id)}}"> Confirm Money Sent </a>
                                <a class="dropdown-item" href="{{ route('show.loan-repay-form', $application->id)}}"> Make Payment </a>
                                <a class="dropdown-item" href="{{ route('show.loan-charge-form', $application->id)}}"> Add Loan Charge </a>

                                <a class="dropdown-item" href="{{ route('admin.loan-payment-history', $application->id)}}">Show payment history </a>

                                {{--
                                <a class="dropdown-item" href="{{ route('applications.edit',$application->id)}}"><i class="fas fa-edit"></i> Edit Loans </a>
                                <a class="dropdown-item" href="#"><i class="fas fa-ban"></i> Reject loan</a>
                                 --}}
                                <a class="dropdown-item" type="submit" onclick="return confirm('Are you sure ? this will delete the record permanently')"
                                   href="{{ route('applications.destroy', $application->id)}}">
                                    {{--
                                    <form action="{{ route('applications.destroy', $application->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">  </button>
                                    </form>


                                    <i class="far fa-trash-alt"></i> Cancel loan
                                     --}}

                                </a>

                            </div>
                        </div>
