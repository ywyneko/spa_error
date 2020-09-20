<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="product.name">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" v-model="product.price">
                    </div>
                    <button @click="store()" type="submit" class="btn btn-primary">Add Product</button>
                </div>
                <div class="col-8">
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                        <tr v-for = "product in products">
                            <td> @{{product.id}} </td>
                            <td> @{{product.name}} </td>
                            <td>$ @{{product.price}} </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        new Vue({
            el : "#app",
            data : {
                products : [],
                product : {
                    name : '',
                    price : ''
                },
                created(){
                    this.index()
                },
                methods : {
                    index(){
                        axios.get('/api/product').then(res => this.products = res.data.products)
                    },
                    store(){
                        let product = {
                            name : this.product.name,
                            price : this.product.price,
                        }
                        axios.post('/api/product',{
                            name : product.name,
                            price : product.price
                        }).then(res =>{
                            this.index();
                            this.product = {name : '',price: ''}
                        })
                    }
                }
            }
        });
    </script>
</body>
</html>
