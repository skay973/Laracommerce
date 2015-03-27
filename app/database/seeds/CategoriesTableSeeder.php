<?php

class CategoriesTableSeeder extends Seeder {

    public function run() {
        $category1 = new Category;
        $category1->name = 'Oursons';

        $category1->save();

        $category2 = new Category;
        $category2->name = 'Chatons';

        $category2->save();

        $category3 = new Category;
        $category3->name = 'Souris';

        $category3->save();

        $category4 = new Category;
        $category4->name = 'Chats';

        $category4->save();

        $category5 = new Category;
        $category5->name = 'Disney';

        $category5->save();

        $category6 = new Category;
        $category6->name = 'Films';

        $category6->save();

        $category7 = new Category;
        $category7->name = 'Dessins animés';

        $category7->save();
    }
}
