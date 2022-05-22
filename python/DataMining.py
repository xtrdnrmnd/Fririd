# Data Mining
import csv
# WEIGHTS of the modules
STATUS = 0.5
VISA = 0.2
SAFETY = 0.2
PRICE = 0.1


# Method to calculate the status
# def status(f, t):
# somwthing

# Method to calculate the safety


def safety(f, t):
    crimeRateData = open('../data/crimeIndex.csv', 'r')

# Method to get the visa information
# def visa():
# something

# Method to calculate expenses


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
        return 1
    elif ():
        return 2
    elif ():
        return 3
    else:
        return 4

# Algorithm to calculate the rating


def count(S, V, B, P):
    R = S * 5 / SMAX + V * 2 / VMAX + B * 2 / BMAX + P / PMAX
    return R


def main(fromC, toC):
    return count(status(fromC, toC), visa(fromC, toC), safety(fromC, toC), expenses(fromC, toC))


expenses("Egypt", "Canada")
