<?php

/**
 * 1. Отформатировать код согласно psr
 * 2. Создать интерфейсы
 * 3. При создании фильма должна использоваться константа, а не число
 * 4. Метод statement разбить на более мелкие
 */

class Statement
{
    public static function get(string $type, array $data): string
    {
        $formatter = FormatterFactory::make($type);

        return $formatter->format($data);
    }
}

class Customer
{
    /** @var string */
    public $name;
    /** @var array */
    public $rentals;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addRental(Rental $rental): void
    {
        $this->rentals[] = $rental;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStatementData(): array
    {
        $totalAmount = 0;

        foreach ($this->rentals as $rental) {
            $rentalData = $rental->getStatementData();
            $totalAmount += $rentalData['amount'];

            $data['body'][] = $rentalData;
            $data['total_frequent'] += $rental->getFrequentRenterPoints();
        }

        $data['name'] = $this->getName();
        $data['total_amount'] = $totalAmount;

        return $data;
    }
}

abstract class Movie
{
    /** @var string */
    public $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

}


class ChildrenMovie extends Movie implements MovieInterface
{
    public function getAmount(int $days): float
    {
        $amount = 1.5;
        if ($days > 3) {
            $amount += ($days - 3) * 1.5;
        }

        return $amount;
    }
}

class NewReleaseMovie extends Movie implements MovieInterface
{
    public function getAmount(int $days): float
    {
        return $days * 3;
    }
}

class RegularMovie extends Movie implements MovieInterface
{
    public function getAmount(int $days): float
    {
        $amount = 2;
        if ($days > 2) {
            $amount += ($days - 2) * 1.5;
        }

        return $amount;
    }
}


class Rental
{
    /** @var Movie */
    public $movie;
    /** @var int */
    public $daysRented;

    public function __construct(MovieInterface $movie, int $daysRented)
    {
        $this->movie = $movie;
        $this->daysRented = $daysRented;
    }

    public function getDaysRented(): int
    {
        return $this->daysRented;
    }

    public function getMovie(): MovieInterface
    {
        return $this->movie;
    }

    public function getStatementData(): array
    {
        $amount = $this->movie->getAmount($this->daysRented);
        $title = $this->movie->getTitle();

        return compact('amount', 'title');
    }

    public function getFrequentRenterPoints(): int
    {
        if (!$this->movie instanceof NewReleaseMovie) {
            return 1;
        }

        return ($this->daysRented > 1) ? 2 : 1;
    }
}


abstract class FormatterFactory
{
    public static function make(string $type)
    {
        $class = ucfirst($type) . 'Formatter';
        if (class_exists($class)) {
            return new $class;
        }
        throw new \Exception("Class {$class} is not exist");
    }
}

class HtmlFormatter
{
    public function format(array $data)
    {
        ob_start();
        include('statement-html.php');
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}

class TextFormatter
{
    public function format(array $data)
    {
        $result[] = $data['name'];

        foreach ($data['body'] as $body) {
            $result[] = "{$body['title']} \t {$body['amount']}";
        }

        $result[] = "Amount owed is {$data['total_amount']}";
        $result[] = "You earned {$data['total_frequent']} frequent renter points";

        return implode(PHP_EOL, $result);
    }
}

interface MovieInterface
{
    public function getAmount(int $days): float;
}


// define customer
$customer = new Customer('Adam Culp');
// choose movie to be rented, define rental, add it to the customer
$movie = new RegularMovie('Gladiator');
$rental = new Rental($movie, 1);
$customer->addRental($rental);
// choose 2nd movie to be rented, define rental, add it to the customer
$movie = new NewReleaseMovie('Spiderman');
$rental = new Rental($movie, 2);
$customer->addRental($rental);
// print the statement

echo Statement::get('HtmL', $customer->getStatementData());