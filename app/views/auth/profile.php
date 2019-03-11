<div class="">
    <div class="tab">
        <a class="tablinks active" href="<?= URL ?>/user/profile">Dashboard</button>
        <a class="tablinks" href="<?= URL ?>/product">Products</button>
        <!-- <button class="tablinks" onclick="openCity(event, 'Subscription')">Add Subscription</button> -->
    </div>

    <div id="New-Item" class="tabcontent" style="display: block;">
        <div class="inventory-title"><h3>DASHBOARD</h3></div>
            <div class="container">
                <div class="row">
            
                    <div class="f3">
                        <div class="media-v1">
                            <img src="<?= URL ?>/img/default-user.png">
                        </div>
                            <a href="Aboutus.php"><button type="button" class="btn btn-black">Edit Profolio</button></a>
                        <div class="profile-text">
                            <h3>Profile Info</h3>
                            <h4>Username: <?= $this->user->username ?></h4>
                            <h4>User Type: <?= $this->user->is_contributer ? 'Contribuer' : 'Subscriber' ?></h4>
                        </div>
                    </div>
                
                    <div class="f2">
                        <div class="media-v1">
                            <iframe width="100%" height="400px" src="https://www.youtube.com/embed/_iahdbRc_aA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                            <a href="Aboutus.php"><button type="button" class="btn btn-black">New Order</button></a>
                        <div class="profile-text">
                            <h3>New Orders</h3>
                        </div>
                        <div class="media-text">
                            <p>“It's very hard in the beginning to understand that the whole idea is not to beat the other runners. Eventually you learn that the competition is against the little voice inside you that wants you to quit.”     
                            — George Sheehan
                        </p>
                        </div>
                    </div>

                    <div class="f4">
                        <div class="profile-text">
                            <h3>Categories</h3>
                        </div>
                        <div class="media-text">
                            <p>Here You Manage Your Categories and Add new Categories
                        </p>
                        </div>
                        <a href="Aboutus.php"><button type="button" class="btn btn-black">Add</button></a>
                        <a href="Aboutus.php"><button type="button" class="btn btn-orange">Manage</button></a>
                    </div>

                    <div class="f4">
                        <div class="profile-text">
                            <h3>Subscribers</h3>
                        </div>
                        <div class="media-text">
                            <p> Here you manage Your Subscribers and Add new subscribers
                        </p>
                        </div>
                            <a href="Aboutus.php"><button type="button" class="btn btn-black">Add</button></a>
                        <a href="Aboutus.php"><button type="button" class="btn btn-orange">Manage</button></a>
                    </div>

                    <div class="f4">
                        <div class="profile-text">
                            <h3>Products</h3>
                        </div>
                        <div class="media-text">
                            <p>Here You Manage Your Products and Add your new Products
                        </p>
                        </div>
                            <a href="Aboutus.php"><button type="button" class="btn btn-black">Add</button></a>
                        <a href="<?= URL ?>/product"><button type="button" class="btn btn-orange">Manage</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="Products" class="tabcontent">
        <div class="profile-text">
        <h3>Products</h3>
        </div>
        <table>
        <tr>
            <th>Photo</th>
            <th>Product ID</th>
            <th>Name/Brand</th>
            <th>Category</th>
            <th>Description</th>
            <th>Price</th>
            <th>Edit
        </th>
        </tr>

        <tr>
            <td><img class="product-img" src="img/default-user.png"></td>
            <td>Alfreds Futterkiste</td>
            <td>Maria Anders</td>
            <td>Germany</td>
            <td>eqfwewfewfewf</td>
            <td>$200</td>
            <td> <div class="input_field checkbox_option">
                    <input type="checkbox" id="cb1">
            </div></td>
        </tr>
        <tr>
            <td><img  class="product-img" src="img/default-user.png"></td>
            <td>Centro comercial Moctezuma</td>
            <td>Francisco Chang</td>
            <td>Mexico</td>
            <td>eqfwewfewfewf</td>
            <td>$200</td>
            <td> <div class="input_field checkbox_option">
                    <input type="checkbox" id="cb1">
            </div></td>
        </tr>
        <tr>
            <td><img  class="product-img" src="img/default-user.png"></td>
            <td>Ernst Handel</td>
            <td>Roland Mendel</td>
            <td>Austria</td>
            <td>eqfwewfewfewf</td>
            <td>$200</td>
            <td> <div class="input_field checkbox_option">
                    <input type="checkbox" id="cb1">
            </div></td>
        </tr>
        <tr>
            <td><img  class="product-img" src="img/default-user.png"></td>
            <td>Island Trading</td>
            <td>Helen Bennett</td>
            <td>UK</td>
            <td>eqfwewfewfewf</td>
            <td>$200</td>
            <td> <div class="input_field checkbox_option">
                    <input type="checkbox" id="cb1">
            </div></td>
        </tr>
        </table>
        <a href="Aboutus.php"><button type="button" class="btn btn-black">Create New</button></a>
        <a href="Aboutus.php"><button type="button" class="btn btn-orange">Edit</button></a>
    </div>
</div>