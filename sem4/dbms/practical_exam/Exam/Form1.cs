﻿using System;
using System.Data.SqlClient;
using System.Windows.Forms;

namespace Exam
{
    public partial class Form1 : Form
    {
        private static readonly string conn_string = "Server=DESKTOP-R4AMR8A\\SQLEXPRESS;Database=jale;Trusted_Connection=True";
        SqlDataAdapter adapter = null;

        public Form1()
        {
            InitializeComponent();
        }

        private void dataGridView1_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {
            // dataGridView1 == dgvCategories

            // Get category PK from row clicked by user
            var row = dgvCategories.Rows[e.RowIndex];
            var masterId = row.Cells[0].Value.ToString();

            SqlConnection connection;
            using (connection = new SqlConnection(conn_string))
            {
                // Select Movies using the masterId as foreign key
                connection.Open();
                SqlCommand query = new SqlCommand("SELECT * FROM Movies WHERE mc_id=@Id", connection);
                query.Parameters.Add(new SqlParameter("@Id", masterId));
                adapter = new SqlDataAdapter(query);
                int result = adapter.Fill(jaleDataSet, "Movies");
                this.dgvMovies.DataSource = jaleDataSet.Tables["Movies"];
                connection.Close();
            }
        }

        private void dataGridView2_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {
            // dataGridView2 == dgvMovies
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            // Generated by WFA, ignore
            // TODO: This line of code loads data into the 'jaleDataSet.Categories' table. You can move, or remove it, as needed.
            this.categoriesTableAdapter.Fill(this.jaleDataSet.Categories);
            // TODO: This line of code loads data into the 'jaleDataSet.Movies' table. You can move, or remove it, as needed.
            this.moviesTableAdapter.Fill(this.jaleDataSet.Movies);
        }

        private void commitButton_Click(object sender, EventArgs e)
        {
            // Commit changes in the database
            if (adapter != null)
            {
                // Else user clicks Commit button without previous changes
                adapter.Update(jaleDataSet, "Movies");
                adapter.Update(jaleDataSet, "Categories");
            }
        }
    }
}
