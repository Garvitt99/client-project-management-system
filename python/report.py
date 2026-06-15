import mysql.connector
import pandas as pd

conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="client_manager"
)

query = """
SELECT
    c.client_name,
    c.company_name,
    p.project_name,
    p.budget,
    p.project_status,
    p.payment_status
FROM clients c
INNER JOIN projects p
ON c.client_id = p.client_id
"""

df = pd.read_sql(query, conn)

df.to_excel(
    r"C:\xampp\htdocs\client-manager\python\client_report.xlsx",
    index=False
)

print("Report Generated Successfully!")

conn.close()