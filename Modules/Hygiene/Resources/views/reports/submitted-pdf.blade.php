<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Submitted Inspections</title>
    <style>
        table, th, td{
            border: 1px solid black;
            border-collapse: collapse;
        }
        .body-block{
            display:flex;
            margin-bottom: 50px
        }
        .thumbnail{
            padding: 2px;
            margin-right:-2px;
            border: 2px solid black;
        }
        
        .right{
            float:right;
            margin-bottom: 10px;
            width:50%;
        }

        .left{
            float:left;
            margin-bottom: 10px;
            width:50%;
        }
        .container{
            max-width: 1000px; margin:0 auto; background: #f8f8ff; border:1px solid #e7e7ff; padding: 0px 15px 15px 15px; font-size: 16px; font-family: arial;
        }
    </style>
</head>
<body>
    <div class="container" style="">

    <div class="header-block">
        <h3 style="text-align: center">Inspection List({{ $title }})</h3>
    </div>

    <section>
        <table style="width: 100%; border-bottom: 5px solid #5757e7;">
            <tr>
                <td>
                    <span alt="" style="width: 120px; height: 70px; text-align: left;">One football </span>
                </td>
                <td style="text-align: right; font-size: 20px; text-transform: uppercase;">
                    <h2 style="font-weight: 900; color:#5757e7;">Cost Estimation</h2>
                </td>
            </tr>
        </table>
    </section>
    <table>
        <thead>
          <tr>
            <th>SN.</th>
            <th>Location</th>
            <th>Starting Date</th>
            <th>Findings</th>
            <th>Pictures</th>
            <th>Protective Corrective Actions</th>
            <th>Accountibility</th>
            <th>Status</th>
            <th>Closing Date</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($inspections as $key =>$inspection)
                <tr>
                    <td>{{ $key+1 }}.</td>
                    <td>{{ $inspection->location }}</td>
                    <td>{{ $inspection->start_date }}</td>
                    <td>{{ $inspection->findings }}</td>
                    <td>
                        @forelse ($inspection->pictures as $item)
                            <img class="thumbnail" src="{{ public_path('images/inspection_file/pictures').'/'.$item->name }}" width="100px" height="100px" alt=""><br>
                        @empty
                            <p>No picture found!</p>
                        @endforelse
                    </td>
                    <td>{{ $inspection->pca }}</td>
                    <td>{{ $inspection->accountibility }}</td>
                    <td>{{ $inspection->status==1?"Open":"Close" }}</td>
                    <td>{{ $inspection->closing_date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No Inspection found!</td>
                </tr>
            @endforelse
          
        </tbody>
      </table>
    </div>
    
    </body>
</html>