<?php 


class  Product {

    private string $title;
    private string $mark;
    private string $model;
    private string $power;
    private string $year;
    private string $description;
    private int $starting_price;
    private string $end_date; 
    private int $last_price;


    public function __construct ($title, $mark, $model, $power, $year, $description,$starting_price, $end_date)
    {
    $this->title=$title;
    $this->mark=$mark;
    $this->model=$model;
    $this->power=$power;
    $this->year=$year;
    $this->description=$description;
    $this->starting_price=$starting_price;
    $this->end_date=$end_date;
    }

    public function __get ($property) {
        if ($property === "title") {
            return $this->title;
        } else if ($property === "mark") {
            return $this->mark;
        } else if ($property === "model") {
            return $this->model;
        } else if ($property === "power") {
            return $this->power;
        } else if ($property === "year") {
            return $this->year;
        } else if ($property === "description") {
            return $this->description;
        } else if ($property === "starting_price") {
            return $this->starting_price;
        } else if ($property === "end_date") {
            return $this->end_date;
        } else if ($property === "last_price") {
            return $this->last_price;
        } else {
            return $this->$property;
        }
    }

   public function save () {
    require __DIR__."/../dataBase.php";
    $query=$dbh->prepare("INSERT INTO `product` (title,mark,model,power,year,description,starting_price, end_date) VALUES (:title,  :mark,:model, :power, :year, :description,:starting_price, :end_date)");
    $query->bindValue(':title', $this->title, PDO::PARAM_STR);
    $query->bindValue(':mark', $this->mark, PDO::PARAM_STR);
    $query->bindValue(':model', $this->model, PDO::PARAM_STR);
    $query->bindValue(':power', $this->power, PDO::PARAM_STR);
    $query->bindValue(':year', $this->year, PDO::PARAM_INT);
    $query->bindValue(':description', $this->description, PDO::PARAM_STR);
    $query->bindValue(':starting_price', $this->starting_price, PDO::PARAM_INT);
    $query->bindValue(':end_date', $this->end_date, PDO::PARAM_STR);
    $results=$query->execute();
    if($results){ ?>
        <div class="alert alert-success" role="alert">
            Votre annonce a été créee avec succès.
        </div>
        <?php header("Location: home.php");
        exit;
}
   }}