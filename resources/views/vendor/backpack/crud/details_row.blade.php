@php
    if($document["content_file"] !== "null"){
                $contents = App\Libs\DiskPathTools\DiskPathInfo::parse($document["content_file"])->read();
           }
@endphp
<div>
    <h4>Information :</h4>
    <table class="information">
        <tr>
            <th>ID :</th>
            <td><p>{{$document['id']}}</p></td>
        </tr>
        <tr>
            <th>Title :</th>
            <td><p>{{$document['title']}}</p></td>
        </tr>
        <tr>
            <th>Author :</th>
            <td><p>{{$document['author']}}</p></td>
        </tr>
        <tr>
            <th>Referer Link :</th>
            <td><p><a href="{{$document['referer']}}" target="_blank">{{$document['referer']}}</a></p></td>
        </tr>
        <tr>
            <th>Download Link :</th>
            <td><p><a href="{{$document['download_link']}}" target="_blank">{{$document['download_link']}}</a></p></td>
        </tr>
        <tr>
            <th>Content :</th>
            <td><p>{{$contents}}</p></td>
        </tr>
        <tr>
            <th>Date :</th>
            <td><p>{{$document['created_at']}}</p></td>
        </tr>
    </table>
    <br/>
</div>

<style>
    .information {
        table-layout: fixed;
        width: 100%;
    }

    table tr td p {
        white-space: initial;
    }
</style>
