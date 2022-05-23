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
    return 3


# Function to calculate the safety
def safety(f, t):
    crimeRateData = open('./data/crimeIndex.csv', 'r')
    return 5


# Function to get the visa information
def visa(fromC, toC):
    with open('./data/visa.csv', 'r') as f:
        mycsv = csv.reader(f)
        cStatus = ""
        for row in mycsv:
            if row[0][0] == fromC[0] and row[0][1] == fromC[1] and row[0][2] == fromC[2] and row[0][3] == fromC[3]:
                if toC in row[1].replace(" ", ""):
                    cStatus = row[2]

        print(cStatus)
    if (cStatus == "Visa not required"):
        print(4)
    elif (cStatus == "Visa on arrival"):
        print(3)
    elif (cStatus == "Visa required"):
        print(1)
    else:
        print(2)


def expenses(fromC, toC):
    # Finding average salary and average salary of "from" Country
    with open('./data/Salary_avg.csv', 'r') as f:
        mycsv = csv.reader(f)
        salaryFrom = ""
        salaryTo = ""
        for row in mycsv:
            if row[0] == fromC:
                salaryFrom += row[1]
            if row[0] == toC:
                salaryTo += row[1]

    with open('./data/csvData.csv', 'r') as f2:
        mycsv2 = csv.reader(f2)
        costFrom = ""
        costTo = ""
        for row in mycsv2:
            if row[1] == fromC:
                costFrom += row[2]
            if row[1] == toC:
                costTo += row[2]

    salaryTo = float(salaryTo.replace(",", ""))
    salaryFrom = float(salaryFrom.replace(",", ""))
    costTo = float(costTo)
    costFrom = float(costFrom)
    if (salaryFrom > salaryTo + 800):
        if (costFrom > costTo - 30):
            print("10 " + str(salaryTo) + " " + str(salaryFrom) +
                  "    " + str(costFrom) + " " + str(costTo))
        else:
            print("9 " + str(salaryTo) + " " + str(salaryFrom) +
                  "    " + str(costFrom) + " " + str(costTo))
    elif (salaryFrom > salaryTo + 400 and salaryFrom <= salaryTo + 800):
        if (costFrom > costTo - 30):
            print("8 " + str(salaryTo) + " " + str(salaryFrom) +
                  "    " + str(costFrom) + " " + str(costTo))
        else:
            print("7 " + str(salaryTo) + " " + str(salaryFrom) +
                  "    " + str(costFrom) + " " + str(costTo))
    elif (salaryFrom <= salaryTo + 400 and salaryFrom >= salaryTo - 400):
        if (costFrom > costTo - 30):
            print("6 " + str(salaryTo) + " " + str(salaryFrom) +
                  "    " + str(costFrom) + " " + str(costTo))
        else:
            print("5 " + str(salaryTo) + " " + str(salaryFrom) +
                  "    " + str(costFrom) + " " + str(costTo))
    elif (salaryFrom < salaryTo - 400 and salaryFrom >= salaryTo - 800):
        if (costFrom > costTo - 30):
            print("4 " + str(salaryTo) + " " + str(salaryFrom) +
                  "    " + str(costFrom) + " " + str(costTo))
        else:
            print("3 " + str(salaryTo) + " " + str(salaryFrom) +
                  "    " + str(costFrom) + " " + str(costTo))
    else:  # salaryto < salaryfrom - 800
        if (costFrom > costTo - 30):
            print("2 " + str(salaryTo) + " " + str(salaryFrom) +
                  "    " + str(costFrom) + " " + str(costTo))
        else:
            print("1 " + str(salaryTo) + " " + str(salaryFrom) +
                  "    " + str(costFrom) + " " + str(costTo))

# Algorithm to calculate the rating


def count(S, V, B, P):
    R = S * 5 / SMAX + V * 2 / VMAX + B * 2 / BMAX + P / PMAX
    print(R)


def main(fromC, toC):
    return count(status(fromC, toC), visa(fromC, toC), safety(fromC, toC), expenses(fromC, toC))


visa("Austria", "Egypt")
