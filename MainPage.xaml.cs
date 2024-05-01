using Microsoft.Maui.Controls;
namespace StemWijzer
{
    public partial class MainPage : ContentPage
    {
        public MainPage()
        {
            InitializeComponent();
        }

        private async void OnBeginHereClicked(object sender, EventArgs e)
        {
            await Navigation.PushAsync(new StellingPage());
        }
    }
}
