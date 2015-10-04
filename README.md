CSV File Handler (CsvFileHandler)
=================================

A library that loads and parses a CSV file, returning an object of the file with each CSV line as an object (Licence: GPL-2.0)

<h2>Installation</h2>

<h3>Included in a PHP Project w/ Composer</h3>

Add the following to your composer.json file using the latest version number or 1.0.* to keep it fresh:

```JSON
"require": {
  "daleattree/csvfilehandler": "1.0.*"
}

<h2>Usage</h2>

```PHP
$csvFileHandler = new daleattree\CsvFileHandler\CsvFileHandler($filename, [$headerRow = true], [$delimiter = ','], [$enclosure = '"'], [$escape = '\\']);```

<h3>Example</h3>

<b>CSV File Content</b>
<pre>
id,greeting1,greeting2,salutation
1,"Regards, Test",hello,"there"
</pre>

```PHP
foreach($csvFileHandler->getRecords() as $record){
  echo $record->getId() . PHP_EOL . $record->getGreeting2()() . ' ' . $record->getSalutation() . PHP_EOL . $record->getGreeting1() . PHP_EOL;
}```

<b>OUTPUT</b>
<pre>
1<br/>
hello there<br/>
Regards, Test
</pre>

<p>If there is a header row, the column names will be camel-cased and accessible on RecordObject via get[ColumnName] and set[ColumnName]</p>
<p>If there is no header row, column names default to col[n], n being the column index (zero-based).</p>
<p></p>
