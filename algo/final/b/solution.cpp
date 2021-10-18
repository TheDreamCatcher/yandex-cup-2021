#include <iostream>

using namespace std;

int main()
{
    int t;
    cin>>t;
    for (int q=0;q<t;q++)
    {
        int n;
        cin>>n;
        if (n%2==0)
        {
            cout<<2<<endl;
            cout.flush();
        }
        else
        {
            cout<<1<<endl;
            cout.flush();
            cout<<n<<endl;
        }
        while(true)
        {
            int f;
            cin>>f;
            if (f==0)
                break;
            if(f%2==0)
            {
                cout<<f-1<<endl;

            }
            else
            {
                cout<<f+1<<endl;
            }
            cout.flush();
        }


    }
    return 0;
}
