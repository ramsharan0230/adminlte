<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Submitted Inspections</title>
</head>
<body>
    <div class="header-block">
        <h3 style="text-align: center">Inspection List</h3>
    </div>
    <div class="nav mobilenav">

        <div class="links">
          <a href="/institutions/">Institutioner</a>
          <a href="/leaders/">Ledere</a>
        </div>
      
      <div class="header-title">Institution institution 1</div>
      
      <div class="logout"><a class="button-dark" href="/user/logout">Log ud</a></div>
      
      </div>
    <table class="table">
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
                            {{ $item->name }}
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
</body>
</html>