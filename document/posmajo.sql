SELECT a.*, b.name unit_name, c.name category_name, d.name supplier_names
                    FROM products a
                    JOIN units b ON a.unit_id = b.id
                    JOIN categories c ON a.category_id = c.id
                    JOIN suppliers d ON a.supplier_id = d.id
                    
                    
select * from products p ;