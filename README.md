Goal is to have a callable something like this:

```php
$leases = new LeaseDataset();
$result = $leases->fromDB(DBType::MASTER)
                 ->usingWriteThrough()
                 ->fetchByLeaseID($leaseID);
                 ->get();
```

# Understanding the problem

We want to create a generic dataset that can be used to fetch data from a database. The dataset should be able to fetch data from a master database and a slave database. The dataset should also be able to use write-through caching to cache data fetched from the database. A dataset may have multiple fetch methods that can be used to fetch data from the database. The dataset should be able to fetch data from the database using the fetch methods and return the fetched data. Dataset can also fetch data from multiple tables in the database.
eg. Propety dataset can fetch data from properties table, property_gl_settings table and property_charge_settings table.

If data from any of the table is modified, the dataset should be able to invalidate the cache for that table.

# Understanding the solution

We can create a abstract dataset class that can be extended by the concrete dataset classes. The abstract dataset class can have methods to fetch data from the database, cache the fetched data and invalidate the cache. The concrete dataset classes can implement the fetch methods to fetch data from the database. The concrete dataset classes can also implement the methods to invalidate the cache. The concrete dataset classes can also implement the methods to fetch data from multiple tables in the database.

# Design

1. Create an abstract dataset class that can be extended by the concrete dataset classes.
2. The abstract dataset class should have methods to fetch data from the database, cache the fetched data and invalidate the cache.
3. The concrete dataset classes should implement the fetch methods to fetch data from the database.

# Implementation

1. Create an abstract dataset class that can be extended by the concrete dataset classes.
2. Create a repository class that can be used to fetch data from the database. It will have methods to fetch data from the master database and the slave database. It will also have methods to cache the fetched data and invalidate the cache. It will return the fetched data as dataset objects.
3. Create a concrete dataset class that extends the abstract dataset class. It will implement the fetch methods to fetch data from the database. It will also implement the methods to invalidate the cache.
