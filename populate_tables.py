# Creates SQL scripts (written to sqlscript) for inserting values from the data folder into the database

import csv

insert_cereal_info = []
insert_cereal_manu = []
insert_nutritional_info = []

manu_dict = {"A":"American Home Food Products",
            "G":"General Mills",
            "K":"Kelloggs",
            "N":"Nabisco",
            "P":"Post",
            "Q":"Quaker Oats",
            "R":"Ralston Purina"}

# Open file 
with open('data/cereal.csv') as file_obj:
      
    # Create reader object by passing the file 
    # object to reader method
    reader_obj = csv.reader(file_obj)
      
    # Iterate over each row in the csv 
    # file using reader object
    index_dict = {}
    for i, r in enumerate(next(reader_obj)):
        index_dict[r] = i
    print(index_dict)

    count = 0
    for row in reader_obj:
        count += 1
        cereal_name = row[index_dict["name"]]
        cereal_type = row[index_dict["type"]]
        cereal_manu = manu_dict[row[index_dict["mfr"]]]
        serving_size = row[index_dict["weight"]]
        calories = row[index_dict["calories"]]
        protein = row[index_dict["protein"]]
        fat = row[index_dict["fat"]]
        sugars = row[index_dict["sugars"]]
        vitamins = row[index_dict["vitamins"]]
        sodium = row[index_dict["sodium"]]
        fiber = row[index_dict["fiber"]]
        carbo = row[index_dict["carbo"]]
        potass = row[index_dict["potass"]]


        insert_nutritional_info.append(f"INSERT INTO nutritional_statement (`cereal_id`, `serving_size`, `calories`, `protein`, `fat`, `sugars`, `vitamins`, `sodium`, `fiber`, `carbohydrate`, `potassium`) \
        VALUES ({count}, {serving_size}, {calories}, {protein}, {fat}, {sugars}, {vitamins}, {sodium}, {fiber}, {carbo}, {potass});")
        insert_cereal_manu.append(f"INSERT INTO cereal_manufacturer (name, manufacturer) VALUES (\"{cereal_name}\", \"{cereal_manu}\");")
        insert_cereal_info.append(f"INSERT INTO cereal_info (cereal_id, name, type) VALUES ({count}, \"{cereal_name}\", \"{cereal_type}\");")


with open('sqlscript/insert_nutritional_statement.sql', 'w') as f:
    f.write("\n".join(insert_nutritional_info))

with open('sqlscript/insert_cereal_info.sql', 'w') as f:
    f.write("\n".join(insert_cereal_info))

with open('sqlscript/insert_cereal_manufacturer.sql', 'w') as f:
    f.write("\n".join(insert_cereal_manu))

# Populate other tables with fake data:
tables = ['bookmarks', 'club', 'comment', 'creates_cereal', 'creates_club', 'joins_club', 'user_information', 'user_validation', 'vote']
numerical_columns = {'club_id', 'comment_id', 'cereal_id', 'vote_value',\
                    'personalized_serving_size', 'club_score', 'num_members'}

for name in tables:
    commands = []
    with open(f'data/{name}.csv') as file_obj:
        reader_obj = csv.reader(file_obj)

        column_names = []
        for i, r in enumerate(next(reader_obj)):
            column_names.append(r)
        
        column_tuple = "(" + ", ".join(column_names) + ")"

        for row in reader_obj:
            values = []
            for i, v in enumerate(row):
                if column_names[i] in numerical_columns:
                    values.append(v)
                elif column_names[i]== "date":
                    values.append("\'"+v.split()[0]+"\'")
                else:
                    values.append("\""+v+"\"")

            insert_values = "(" + ", ".join(values) + ")"
            commands.append(f"INSERT INTO {name} {column_tuple} VALUES {insert_values};")

    with open(f'sqlscript/insert_{name}.sql', 'w') as f:
        f.write("\n".join(commands))