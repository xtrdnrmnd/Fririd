# Data Mining
import csv
# WEIGHTS of the modules
STATUS = 0.5
VISA = 0.2
SAFETY = 0.2
PRICE = 0.1

# MAX def of the variables
# Status: closed, partially open, open
SMAX = 3
# Safety: very safe, safe, not safe, dangerous
BMAX = 4
# Price: very cheap, cheap, medium, expensive, very expensive
PMAX = 5
# Visa: no, visa on Arrival, eVisa, visa required
VMAX = 4


# Function to calculate the status
def status(f, t):
    print("kek")


# Function to calculate the safety
def safety(f, t):
    crimeRateData = open('../data/crimeIndex.csv', 'r')


# Function to get the visa information
def visa(fromC, toC):
    with open('./data/visa.csv', 'r') as f:
        mycsv = csv.reader(f)
        cStatus = ""
        for row in mycsv:
            if row[0][0] == fromC[0] and row[0][1] == fromC[1] and row[0][2] == fromC[2] and row[0][3] == fromC[3]:
                if toC in row[1].replace(" ", ""):
                    cStatus = row[2]

        return (cStatus)


def expenses(fromC, toC):
    # Finding average salary and average salary of "from" Country
    with open('./data/Salary_avg.csv', 'r') as f:
        mycsv = csv.reader(f)
        allAvgSal = 0
        numSalRows = 0
        salary = ""
        for row in mycsv:
            if row[0] == fromC:
                salary += row[1]
            if row[1] != "Amount($)":
                row = row[1].replace(",", "")
                numSalRows += 1
                allAvgSal += float(row)

    with open('./data/csvData.csv', 'r') as f2:
        mycsv2 = csv.reader(f2)
        CostOfLivingplRent = 0
        partCost = ""
        numSalRows2 = 0
        for row in mycsv2:
            if row[1] == fromC:
                partCost += row[2]
            if row[4] != "costLivingPlusRentIndex":
                numSalRows2 += 1
                CostOfLivingplRent += float(row[4])

    if ():
        return 4
    elif ():
        return 3
    elif ():
        return 2
    else:
        return 1

# Algorithm to calculate the rating


def count(S, V, B, P):
    R = S * 5 / SMAX + V * 2 / VMAX + B * 2 / BMAX + P / PMAX
    return R


def main(fromC, toC):
    return count(status(fromC, toC), visa(fromC, toC), safety(fromC, toC), expenses(fromC, toC))


visa("Egypt", "Russia")
