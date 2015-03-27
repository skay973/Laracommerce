<?php

class ProductsTableSeeder extends Seeder {

    public function run() {
        $category1 = Category::find(1);
        $category2 = Category::find(2);
        $category3 = Category::find(3);
        $category4 = Category::find(4);

        $product1 = new Product;
        $product1->title = 'Matou le chat';
        $product1->description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit';
        $product1->price = 20.00;
        $product1->availability = true;
        $product1->stock = 1;
        $product1->image = 'assets/images/products/IMG_0064.jpg';
        $category4->products()->save($product1);

        $product2 = new Product;
        $product2->title = 'Moustacha le chaton';
        $product2->description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit';
        $product2->price = 20.00;
        $product2->availability = true;
        $product2->stock = 1;
        $product2->image = 'assets/images/products/IMG_0060.jpg';
        $category2->products()->save($product2);

        $product3 = new Product;
        $product3->title = 'Tisane la chatte';
        $product3->description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit';
        $product3->price = 20.00;
        $product3->availability = true;
        $product3->stock = 1;
        $product3->image = 'assets/images/products/IMG_0063.jpg';
        $category4->products()->save($product3);

        $product4 = new Product;
        $product4->title = 'Paul le chaton';
        $product4->description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit';
        $product4->price = 20.00;
        $product4->availability = true;
        $product4->stock = 1;
        $product4->image = 'assets/images/products/IMG_0065.jpg';
        $category2->products()->save($product4);

        $product5 = new Product;
        $product5->title = 'Fred l\'ourson élégant';
        $product5->description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit';
        $product5->price = 20.00;
        $product5->availability = true;
        $product5->stock = 1;
        $product5->image = 'assets/images/products/IMG_0061.jpg';
        $category1->products()->save($product5);

        $product6 = new Product;
        $product6->title = 'Antoine l\'ourson';
        $product6->description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit';
        $product6->price = 20.00;
        $product6->availability = true;
        $product6->stock = 1;
        $product6->image = 'assets/images/products/IMG_0062.jpg';
        $category1->products()->save($product6);

        $product7 = new Product;
        $product7->title = 'Choco l\'ourson';
        $product7->description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit';
        $product7->price = 20.00;
        $product7->availability = false;
        $product7->stock = 1;
        $product7->image = 'assets/images/products/IMG_0059.jpg';
        $category1->products()->save($product7);

        $product8 = new Product;
        $product8->title = 'Gaspard l\'ourson';
        $product8->description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit';
        $product8->price = 20.00;
        $product8->availability = true;
        $product8->stock = 1;
        $product8->image = 'assets/images/products/IMG_0067.jpg';
        $category1->products()->save($product8);

        $product9 = new Product;
        $product9->title = 'Louise la souris';
        $product9->description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit';
        $product9->price = 20.00;
        $product9->availability = false;
        $product9->stock = 1;
        $product9->image = 'assets/images/products/IMG_0066.jpg';
        $category3->products()->save($product9);

    }
}
