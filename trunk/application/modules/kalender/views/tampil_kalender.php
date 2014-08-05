<head>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url('assets/css/ionicons.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="<?php echo base_url('assets/css/fullcalendar/fullcalendar.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/fullcalendar/fullcalendar.print.css'); ?>" rel="stylesheet" type="text/css" media='print' />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/css/AdminLTE.css'); ?>" rel="stylesheet" type="text/css" />
    </head>
    <section class="content-header">
        <h1>
            Calendar
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Calendar</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">


        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <h4 class="box-title">Daftar Agenda</h4>
                    </div>
                    <div class="box-body">
                        <!-- the events -->
                        <div id='external-events'>
                            <div class='external-event bg-green'>Lunch</div>
                            <div class='external-event bg-red'>Go home</div>
                            <div class='external-event bg-aqua'>Do homework</div>
                            <div class='external-event bg-yellow'>Work on UI design</div>
                            <div class='external-event bg-navy'>Sleep tight</div>
                            <p>
                                <input type='checkbox' id='drop-remove' /> <label for='drop-remove'>remove after drop</label>
                            </p>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /. box -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Buat Agenda</h3>
                    </div>
                    <div class="box-body">
                        <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                            <button type="button" id="color-chooser-btn" class="btn btn-danger btn-block btn-sm dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>
                            <ul class="dropdown-menu" id="color-chooser">
                                <li><a class="text-green" href="#"><i class="fa fa-square"></i> Green</a></li>
                                <li><a class="text-blue" href="#"><i class="fa fa-square"></i> Blue</a></li>
                                <li><a class="text-navy" href="#"><i class="fa fa-square"></i> Navy</a></li>
                                <li><a class="text-yellow" href="#"><i class="fa fa-square"></i> Yellow</a></li>
                                <li><a class="text-orange" href="#"><i class="fa fa-square"></i> Orange</a></li>
                                <li><a class="text-aqua" href="#"><i class="fa fa-square"></i> Aqua</a></li>
                                <li><a class="text-red" href="#"><i class="fa fa-square"></i> Red</a></li>
                                <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i> Fuchsia</a></li>
                                <li><a class="text-purple" href="#"><i class="fa fa-square"></i> Purple</a></li>
                            </ul>
                        </div><!-- /btn-group -->
                        <div class="input-group">
                            <input id="new-event" type="text" class="form-control" placeholder="Event Title">
                            <div class="input-group-btn">
                                <button id="add-new-event" type="button" class="btn btn-default btn-flat">Add</button>
                            </div><!-- /btn-group -->
                        </div><!-- /input-group -->
                    </div>
                </div>
            </div><!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-body no-padding">
                        <!-- THE CALENDAR -->
                        <div id="calendar"></div>
                    </div><!-- /.box-body -->
                </div><!-- /. box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
    