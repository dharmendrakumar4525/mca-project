<!DOCTYPE html>
<html lang="en">


    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Invoice</title>

    </head>

    <body>
        <!DOCTYPE html>
        <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">

                <title>{{config('app.name')}}</title>

                <style>
                    *,
                    ::after,
                    ::before {
                        box-sizing: border-box;
                    }

                    .button {
                        color: #fff;
                        background-color: #007bff;
                        line-height: 1;
                        border-top: 10px solid #007bff;
                        border-bottom: 10px solid #007bff;
                        border-right: 18px solid #007bff;
                        border-left: 18px solid #007bff;
                        border-radius: 3px;
                        text-decoration: none;
                        display: inline-block;
                        margin: 10px 0;
                        -webkit-appearance: none;
                    }

                    body {
                        margin: 0;
                        font-size: 13px;
                        line-height: 1.3;
                        font-family: 'Raleway', sans-serif;
                        background-color: #fff;
                        -webkit-font-smoothing: antialiased;
                    }

                    .text-center {
                        text-align: center;
                    }

                    .text-right {
                        text-align: right;
                    }

                    .pdf-container {
                        background: #f9f9f9;
                        border: 1px solid #e0e0e0;
                        padding-bottom: 20px;
                    }

                    .content-container {
                        padding: 20px;
                    }

                    .heading {
                        border: 1px solid #e0e0e0;
                        border-bottom: 3px solid #e0e0e0;
                        padding: 5px;
                        font-weight: 700;
                    }

                    .table-item {
                        border: 1px solid #e0e0e0;
                        padding: 5px;
                        color: #74787e;
                    }

                    .row-attribute {
                        border: 1px solid #e0e0e0;
                        padding: 5px;
                        font-weight: 700;
                    }

                    .pdf-header {
                        width: 100%;
                        padding: 25px 0;
                    }

                    .text-white {
                        color: #fff;
                    }

                    .text-uppercase {
                        text-transform: uppercase;
                    }

                    address {
                        font-style: normal;
                    }
                </style>
                <script>
                    window.print();
                </script>
            </head>


            <body>
                <div class="pdf-container">


                    <div class="content-container">
                        <h2 class="" style="font-size: 19px;font-weight: 600;">
                        </h2>
                        <table cellpadding="0" cellspacing="0" width=100%>
                            <tbody>
                                <tr>
                                    <td class="heading" width=285px> Product</td>
                                    <td class="heading"> Quantity</td>
                                    <td class="heading"> Price</td>
                                </tr>
                                @foreach($orders as $item)
                                <tr>
                                    <td class="table-item" width=285px> </td>
                                    <td class="table-item text-right"> {{$item["quantity"]}}</td>
                                    <td class="table-item text-right"> ${{$item["amount"]}} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--Customer Details-->
                        <table style="margin: 15px 0;" cellpadding="0" cellspacing="0" width=100%>
                            <tbody>
                                <tr>
                                    <td class="heading">Customer Details</td>
                                </tr>
                                <tr>
                                    <td class="table-item"><strong style="padding-right: 5px;">
                                            Email:{{($user->name)}}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-item"><strong style="padding-right: 5px;">Phone:{{($user->phone)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-item"><strong style="padding-right: 5px;">email:{{($user->email)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-item"><strong
                                            style="padding-right: 5px;">Address:{{($user->address)}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                      
                    </div>
                </div>
            </body>

        </html>
    </body>
</html>
