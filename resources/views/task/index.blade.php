<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <script src="jquery-3.7.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <title>Task</title>
</head>
<body>
    <div class="container">
        <div class="m-5 text-center">
            <h2 class="">Task List</h2>
        
                    <form action="{{route('task.store')}}" method="post" class="row g-3 justify-content-md-center">
                        @method('post')
                        @csrf
                        <div class="col-auto">
                                <input type="text" class="form-control" name="task" id="task"/>
                        </div>
                        <div class="col-auto">
                                <button type="submit" class="btn btn-primary add btn-sm">+</button>   
                        </div> 
                    </form>
                
            </div>

            <div id="task-list" class="m-3">
                @if (Session::has('exist'))
                    <div class="alert alert-danger">
                        {{ Session::get('exist') }}
                    </div>
                 @endif   

                @if (Session::has('store'))
                <div class="alert alert-success">
                    {{ Session::get('store') }}
                </div>
                @elseif (Session::has('deleted'))
                <div class="alert alert-danger">
                    {{ Session::get('deleted') }}
                </div>
             @endif 
                <table class="table table-bordered">
                    <thead>
                        <tr>
                          <th scope="col">Task</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                    @forelse ($tasks as $task )
                    
                            @if ($task->taskDone === 1)
                            <tbody>
                            <td>
                                <strike><h3>{{$task->task}}</h3></strike>
                            </td>
                                
                            <td>
                                
                                {{-- <button class="btn btn-warning">Done</button> --}}
                                <div class="btn-group" role="group" aria-label="Basic example">
                                <form action="{{route('taskUndo', $task->id)}}" method="post">
                                    @method('post')
                                    @csrf
                                <button type="submit" class="btn btn-warning btn-sm"><i class="bi bi-arrow-repeat"></i> Undo</button>
                            </form>
                                </div>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                <form action="{{route('task.destroy', $task->id)}}" method="post">
                                    @method('delete')
                                    @csrf
                                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></button>
                            </form>
                               
                            </div>
                            </td>  
                        </tbody>

                        @else

                        <tbody>
                        <td>
                            <h3 class="">{{$task->task}}</h3>
                        </td>
                            
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <form action="{{route('taskDone', $task->id)}}" method="post">
                                    @method('post')
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-check-circle"></i> Done</button>
                                </form>
                            </div>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <form action="{{route('task.destroy', $task->id)}}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></button>
                                </form>
                            </div>
                        </td>  
                        @endif
                    </tbody>

                    @empty
                    <h2>No Data Lists</h2>
                    @endforelse
                </table>
            </div>
        </div>
    </div>

  
   
    

    {{-- <script>
        $(document).ready(function () {
       $(".add").click(function (e) { 
        alert("Add");
    
       });
    });
    </script> --}}
 
</html>